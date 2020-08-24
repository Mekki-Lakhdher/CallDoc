<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('birth_date')
            ->add('phone_number')

//            ->add('roles', ChoiceType::class, array(
//                    'attr'  =>  array('class' => 'form-control'),
//                    'choices' =>
//                        array
//                        (
//                            'ROLE_DOCTOR'=>'ROLE_DOCTOR',
//                            'ROLE_PATIENT'=>'ROLE_PATIENT',
//                        )
//                ,
//                    'multiple' => true,
//                    'required' => true,
//                )
//            )

            ->add('role', ChoiceType::class, [
                'choices'  => [
                    'Doctor'=>'ROLE_DOCTOR',
                    'Patient'=>'ROLE_PATIENT',
                ],
            ])

            ->add('speciality')
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
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
