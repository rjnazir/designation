<?php

namespace App\Form;

use App\Entity\Personnels;
use App\Entity\Unites;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PersonnelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule_pers', NumberType::class, [
                'label' => 'Matricule',
                'required' => true,
                'invalid_message' => 'Veuillez entrer caractère numerique.',
            ])
            ->add('grade_pers', ChoiceType::class, [
                'choices' => [
                    'GCA'   => 'GCA',   'GDI'   => 'GDI',
                    'GBR'   => 'GBR',   'COL'   => 'COL',
                    'LCOL'  => 'LCOL',  'CEN'   => 'CEN',
                    'CNE'   => 'CNE',   'LTN'   => 'LTN',
                    'SLT'   => 'SLT',   'GPCE'  => 'GPCE',
                    'GPHC'  => 'GPHC',  'GP1C'  => 'GP1C',
                    'GP2C'  => 'GP2C',  'GHC'   => 'GHC',
                    'G1C'   => 'G1C',   'G2C'   => 'G2C',
                    'GST'   => 'GST',   'EG'    => 'EG',
                ],
                'label' => 'Grade',
                'expanded' => false,
                'attr'  => [
                    'class' => 'form-group form-control select2 select2-hidden-accessible',
                ]
            ])
            ->add('nom_pers', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('prenoms_pers', TextType::class, [
                'label' => 'Prénoms',
            ])
            ->add('fonctions_pers', TextType::class, [
                'label' => 'Fonction',
                'required' => true,
            ])
            ->add('unites', EntityType::class, [
                'label' => 'Unité',
                'class' => Unites::class,
                'choice_label' => 'InZoneDeListe',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
            ->add('is_out_cr', CheckboxType::class, [
                'label'=>'Est hors CR?',
                'required'  => false,
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnels::class,
        ]);
    }
}
