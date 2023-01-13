<?php

namespace App\Form;

use App\Entity\TypeArmements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypeArmementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_arm', TextType::class, [
                'label' => 'Type armement',
                'required' => true
            ])
            ->add('abreviation_arm', TextType::class, [
                'label' => 'Abréviation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeArmements::class,
        ]);
    }
}
