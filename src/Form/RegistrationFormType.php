<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $year = date("Y");
        $min_year = ($year -150).'-01-01';
        $today = date("Y-m-d");
        $max_year = $today;

        $builder
            ->add('first_name',TextType::class, array(
                'help' => 'Your first name.',
                'attr' => array(
                    'placeholder' => 'John',
                    'style' => 'background-color:white;',
                ),
            ))
            ->add('last_name',TextType::class, array(
                'help' => 'Your last name.',
                'attr' => array(
                    'placeholder' => 'Doe',
                    'style' => 'background-color:white;',
                ),
            ))
            ->add('gender', ChoiceType::class, array(
                'placeholder' => 'Choose option',
                'choices'  => [
                    'Male'=>'Male',
                    'Female'=>'Female',
                    'Other'=>'Other',
                ],
                'help' => 'Your gender.',
            ))
            ->add('birth_date',DateType::class, array(
                'help' => 'Your date of birth.',
                'widget' => 'single_text',
                'attr' => array(
                    'min' => $min_year,
                    'max' => $max_year,
                ),
            ))
            ->add('phone_number', NumberType::class, array(
                'help' => 'Your phone number.',
                'attr' => array(
                    'placeholder' => 'XX XXX XXX',
                    'style' => 'background-color:white;',
                ),
            ))
            ->add('email', EmailType::class, array(
                'help' => 'Your email address.',
                'attr' => array(
                    'placeholder' => 'john-doe@mail.com'
                ),
            ))
            ->add('role', ChoiceType::class, array(
                'placeholder' => 'Choose option',
                'label' => 'Identity',
                'choices'  => [
                    'Doctor'=>'ROLE_DOCTOR',
                    'Patient'=>'ROLE_PATIENT',
                ],
                'help' => 'Your identity.',
            ))
            ->add('roles', ChoiceType::class, array(
                    'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                    'choices' =>
                        array
                        (
                            'ROLE_DOCTOR'=>'ROLE_DOCTOR',
                            'ROLE_PATIENT'=>'ROLE_PATIENT',
                        )
                ,
                    'multiple' => true,
                )
            )
            ->add('speciality', TextType::class, array(
                'help' => 'Your medical speciality.',
                'attr' => [
                    'placeholder' => 'Search',
                    'class' => 'form-control',
                    'style' => 'background-color:white;',
                ],

            ))
            ->add('profile_picture',FileType::class, array(
                'help' => 'Your display profile picture.',
            ))
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => ' ',
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}
