<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'M' => 'M',
                    'Mme' => 'Mme'
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *',
                'label_attr' => [
                    'id' => 'customer_firstnameLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_firstname')",
                    'onblur' => "toggleClassForm('customer_firstname')"
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom *',
                'label_attr' => [
                    'id' => 'customer_lastnameLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_lastname')",
                    'onblur' => "toggleClassForm('customer_lastname')"
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Entreprise',
                'required' => false,
                'label_attr' => [
                    'id' => 'customer_companyLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_company')",
                    'onblur' => "toggleClassForm('customer_company')"
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone *',
                'label_attr' => [
                    'id' => 'customer_phoneLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_phone')",
                    'onblur' => "toggleClassForm('customer_phone')"
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail *',
                'label_attr' => [
                    'id' => 'customer_emailLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_email')",
                    'onblur' => "toggleClassForm('customer_email')"
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse *',
                'label_attr' => [
                    'id' => 'customer_addressLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_address')",
                    'onblur' => "toggleClassForm('customer_address')"
                ]
            ])
            ->add('address_complement', TextType::class, [
                'label' => 'Complément d\'adresse',
                'required' => false,
                'label_attr' => [
                    'id' => 'customer_address_complementLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_address_complement')",
                    'onblur' => "toggleClassForm('customer_address_complement')"
                ]
            ])
            ->add('zip_code', NumberType::class, [
                'label' => 'Code postal *',
                'label_attr' => [
                    'id' => 'customer_zip_codeLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_zip_code')",
                    'onblur' => "toggleClassForm('customer_zip_code')"
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville *',
                'label_attr' => [
                    'id' => 'customer_cityLabel'
                ],
                'attr' => [
                    'onfocus' => "addClassForm('customer_city')",
                    'onblur' => "toggleClassForm('customer_city')"
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'label_attr' => [
                    'id' => 'customer_countryLabel'
                ],
                'data' => 'France',
                'attr' => [
                    'onfocus' => "addClassForm('customer_country')",
                    'onblur' => "toggleClassForm('customer_country')"
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
            'data_class' => Customer::class,
        ]);
    }
}
