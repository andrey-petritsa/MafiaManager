<?php

namespace App\Form;

use App\Entity\Player;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class RegistrationFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add("first_name", null, ['label' => "Имя"])
			->add("last_name", null, ['label' => "Фамилия"])
			->add("patronymic_name", null, ['label' => "Отчество"])
			->add("sex", ChoiceType::class, [
				'choices' => [
					'Мужской' => 'man',
					'Женский' => 'woman',
				],
				'label' => "Выберите пол*"
			])
			->add("nick_name", null, ['label' => "Игровое имя*"])
			->add('email', EmailType::class, ['label' => "Почта*"])
			->add('plainPassword', PasswordType::class, [
				'mapped' => false,
				'attr' => ['autocomplete' => 'new-password'],
				'constraints' => [
					new NotBlank([
						'message' => 'Please enter a password',
					]),
					new Length([
						'min' => 6,
						'minMessage' => 'Your password should be at least {{ limit }} characters',
						// max length allowed by Symfony for security reasons
						'max' => 4096,
					]),
				],
				'label' => "Пароль*"
			])
			->add('agreeTerms', CheckboxType::class, [
				'mapped' => false,
				'constraints' => [
					new IsTrue([
						'message' => 'You should agree to our terms.',
					]),
				],
				'label' => "Я согласен с условиями обработки персональных данных"
			])
			->add("submit", SubmitType::class, ['label' => 'Зарегестрироваться']);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Player::class,
		]);
	}
}
