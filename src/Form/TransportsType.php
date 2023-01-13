<?php

namespace App\Form;

use App\Entity\Transports;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TransportsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_transp', TextType::class, [
                'label' => 'Nom transport',
                'required' => true,
            ])
            ->add('abreviation_transp', TextType::class, [
                'label' => 'Abréviation transport',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transports::class,
        ]);
    }
}
