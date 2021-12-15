<?php

namespace App\Form;

use App\Entity\Mission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de mission',
                'label_attr' => [
                    'id' => 'mission_titleLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('mission_title')",
                    'onblur' => "toggleClassForm('mission_title')"
                ]
            ])
            ->add('details', TextareaType::class, [
                'label' => 'Détails',
                'label_attr' => [
                    'id' => 'mission_detailsLabel'
                ],
                'attr' => [
                    'rows' => '5',
                    'onfocus' => "addClassForm('mission_details')",
                    'onblur' => "toggleClassForm('mission_details')"
                ]
            ])
            ->add('status', TextType::class, [
                'label' => 'Status',
                'label_attr' => [
                    'id' => 'mission_statusLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('mission_status')",
                    'onblur' => "toggleClassForm('mission_status')"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'bg-green-500 hover:bg-green-400 text-white p-2 rounded-md w-full'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
