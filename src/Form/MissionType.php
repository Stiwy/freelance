<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Mission;
use App\Entity\MissionStatus;
use App\Entity\Owner;
use App\Entity\User;
use App\Repository\CustomerRepository;
use App\Repository\MissionStatusRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin de mission',
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
                ]
            ])
            ->add('customer', ChoiceType::class, [
                'label' => 'Client',
                'choices' => $options['customers'],
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
                ]
            ])
            ->add('mission_status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => $options['missionStatus'],
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
                ]
            ])
            ->add('work_duration', IntegerType::class, [
                'label' => 'Heure de travail effectué',
                'data' => 0,
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
                ]
            ])
            ->add('rate', NumberType::class, [
                'label' => 'Prix',
                'label_attr' => [
                    'id' => 'mission_rateLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('mission_rate')",
                    'onblur' => "toggleClassForm('mission_rate')"
                ]
            ])
            ->add('rate_reccurency', ChoiceType::class, [
                'label' => 'Prix par',
                'choices'  => [
                    'Heure' => 'Heure',
                    'Jour' => 'Jour',
                    'Semaine' => 'Semaine',
                    'Mois' => 'Mois',
                    'Année' => 'Année',
                    'Facture unique' => 'Facture unique',
                ],
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
                ]
            ])
            ->add('invoice_recurency', ChoiceType::class, [
                'label' => 'Réccurence de facturation',
                'choices'  => [
                    'Jour' => 'Jour',
                    'Semaine' => 'Semaine',
                    'Mois' => 'Mois',
                    'Année' => 'Année',
                    'Facture unique' => 'Facture unique',
                ],
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
                ],
            ])
            ->add('invoice_deadline_date', DateType::class, [
                'label' => 'Date de la première facturation',
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'label_attr' => [
                    'class' => '-mt-5 bg-white px-1'
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
            'customers' => array(),
            'missionStatus' => array(),
        ]);
    }
}
