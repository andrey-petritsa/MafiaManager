<?php
// src/Controller/MailerController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
	#[Route( '/email-test/', name: 'email_test', methods: ['GET'] )]
	public function sendEmail(MailerInterface $mailer): Response
	{
		$email = (new Email())
			->from('robot@petritsa.ru')
			->to('html-master@internet.ru')
			->subject('Time for Symfony Mailer!')
			->text('Sending emails is fun again!')
			->html('<p>See Twig integration for better HTML integration!</p>');

		$mailer->send($email);
	}
}