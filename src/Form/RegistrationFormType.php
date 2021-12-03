<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[


                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]

            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [

                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 30,
                    ]),
                ],
            ])
            ->add('roles',ChoiceType::class,[
                'choices' =>[
                    'Client' => 'ROLE_CLIENT',
                    'Employer'=> 'ROLE_EMPLOYER',
                    'Administrateur'=> 'ROLE_ADMIN'
                ],
                'expanded'=> true,
                'multiple'=> true,
                'label'=>'Roles'
            ])
            ->add('nomuser')
            ->add('cinuser')
            ->add('ageuser')
            ->add('numtel')
            ->add('sexe')
            ->add('abonnement')
           /* ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
           */
            /*->add('save',SubmitType::class,[
                'label'=>'Registr'
            ])*/
            ->add("captchaCode",CaptchaType::class,[
                'captchaConfig' => 'ExampleCaptchaUserRegistration',
                 'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalid captcha,please try again',
                    ]),

                ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
