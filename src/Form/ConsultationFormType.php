<?php

namespace App\Form;

use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patient_id')
            ->add('doctor_id')
            ->add('date')
            ->add('asked')
            ->add('confirmed')
            ->add('canceled')
            ->add('chat_room_id')
            ->add('confirm', SubmitType::class, ['label' => 'Confirm'])
            ->add('cancel', SubmitType::class, [
                'label' => 'Cancel',
                'attr' => array('class' => 'btn btn-danger'),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
