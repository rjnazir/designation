<?php

namespace App\Form;

use App\Entity\TypesServices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypesServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_type_sce', TextType::class, [
                'label' => 'Type de service',
                'required' => true,
            ])
            ->add('abreviation_type_sce', TextType::class, [
                'label' => 'Abréviation type service',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypesServices::class,
        ]);
    }
}
