<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 06/10/2020
 * Time: 23:46
 */

namespace App\Form;

use App\Entity\HomePageContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomePageContentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content_type',  ChoiceType::class, array(
                'placeholder' => 'Choose option',
                'choices'  => [
                    'Doctor advertisement'=>'doctor_advertisement',
                    'Machine advertisement'=>'machine_advertisement',
                    'Site statistics'=>'site_statistics',
                ],
            ))
            ->add('content_class', ChoiceType::class, array(
                'placeholder' => 'Choose option',
                'choices'  => [
                    'Primary'=>'primary',
                    'Secondary'=>'secondary',
                ],
            ))
            ->add('content_first_title', TextType::class, array(
                'attr' => array(
                    'maxlength' => '30',
                ),
                'help' => 'Maximum 30 characters for a better display.',
            ))
            ->add('content_second_title', TextType::class, array(
                'attr' => array(
                    'maxlength' => '30',
                ),
                'help' => 'Maximum 30 characters for a better display.',
            ))
            ->add('content_photo',FileType::class)
            ->add('content_text', TextareaType::class, array(
                'attr' => array(
                    'maxlength' => '100',
                ),
                'help' => 'Maximum 100 characters for a better display.',
            ))
            ->add('content_first_link', TextType::class, array(
                'attr' => array(
                    'maxlength' => '255',
                ),
            ))
            ->add('content_second_link', TextType::class, array(
                'attr' => array(
                    'maxlength' => '255',
                ),
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomePageContent::class,
        ]);
    }

}