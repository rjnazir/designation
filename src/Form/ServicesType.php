<?php

namespace App\Form;

use App\Entity\Services;
use App\Entity\TypesServices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_sce', TextType::class, [
                'label' => 'Nom service',
                'required' => true,
            ])
            ->add('abreviation_sce', TextType::class, [
                'label' => 'Abréviation service',
                'required' => false,
            ])
            ->add('types_service', EntityType::class, [
                'label' => 'Type de service',
                'class' => TypesServices::class,
                'choice_label' => 'nomTypeSce',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Services::class,
        ]);
    }
}
