<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\LoginFormAuthenticator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
	private $emailVerifier;

	public function __construct(EmailVerifier $emailVerifier)
	{
		$this->emailVerifier = $emailVerifier;
	}

	#[Route('/register', name: 'app_register')]
	public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
	{
		$user = new Player();
		$form = $this->createForm(RegistrationFormType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// encode the plain password
			$user->setPassword(
				$passwordEncoder->encodePassword(
					$user,
					$form->get('plainPassword')->getData()
				)
			);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();

			// generate a signed url and email it to the user
			$this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
				(new TemplatedEmail())
					->from(new Address('robot@petritsa.ru', 'Mafiamanager Mail Bot'))
					->to($user->getEmail())
					->subject('Please Confirm your Email')
					->htmlTemplate('registration/confirmation_email.html.twig')
			);
			$this->addFlash("success", "Ваша учетная запись была зарегистрирована. На почту {} было выслано письмо для подтверждения вашей учетной записи");

			return $guardHandler->authenticateUserAndHandleSuccess(
				$user,
				$request,
				$authenticator,
				'main' // firewall name in security.yaml
			);
		}

		return $this->render('registration/register.html.twig', [
			'registrationForm' => $form->createView(),
		]);
	}

	#[Route('/verify/email', name: 'app_verify_email')]
	public function verifyUserEmail(Request $request): Response
	{
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

		try {
			$this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
		} catch (VerifyEmailExceptionInterface $exception) {
			$this->addFlash('verify_email_error', $exception->getReason());

			return $this->redirectToRoute('app_register');
		}

		$this->addFlash('success', "Ваша учетная запись была успешно подтверждена!");

		return $this->redirectToRoute('index_page');
	}
}
