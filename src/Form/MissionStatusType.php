<?php

namespace App\Form;

use App\Entity\MissionStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', TextType::class, [
                'label' => 'Libellé',
                'label_attr' => [
                    'id' => 'mission_status_statusLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('mission_status_status')",
                    'onblur' => "toggleClassForm('mission_status_status')"
                ],
            ])
            ->add('background_color', ColorType::class, [
                'label' => 'Couleur de fond',
                'data' => '#ffffff',
                'label_attr' => [
                    'id' => 'mission_status_statusLabel',
                    'class' => '-mt-8'
                ]
            ])
            ->add('font_color', ColorType::class, [
                'label' => 'Couleur de texte',
                'label_attr' => [
                    'id' => 'mission_status_statusLabel',
                    'class' => '-mt-8'
                ]
            ])
            ->add('priority', IntegerType::class, [
                'label' => 'Priorité',
                'label_attr' => [
                    'id' => 'mission_status_priorityLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('mission_status_priority')",
                    'onblur' => "toggleClassForm('mission_status_priority')",
                    'min' => 1,
                    'max' => 10
                ],
            ])
            ->add('Enregistrer', SubmitType::class, [
                'attr' => [
                    'class' => 'bg-green-500 hover:bg-green-400 text-white p-2 rounded-md w-full'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MissionStatus::class,
        ]);
    }
}
