<?php

namespace App\Form;

use App\Entity\Unites;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class UnitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_ute', TextType::class, [
                'label' => 'Nom de l\'unité',
                'required' => true,
            ])
            ->add('localite_ute', TextType::class, [
                'label' => 'Localité de l\'unité',
                'required' => true,
            ])
            ->add('abreviation_ute', TextType::class, [
                'label' => 'Abréviation de l\'unité',
                'required' => true,
            ])
            ->add('contact_ute', TextType::class, [
                'label' => 'Contact de l\'unité',
                'required' => false,
            ])
           /* ->add('unites', EntityType::class, [
                'label' => 'Unité',
                'class' => Unites::class,
                'choice_label' => 'unites.nomUte',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])            
           ->add('unites', Collection::class, [
                'label' => 'Unité supérieure',
                'choice_label' => 'InZoneDeListe',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
                'error_mapping' => [
                    '.' => 'Unité',
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Unites::class,
        ]);
    }
}
