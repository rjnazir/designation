<?php

namespace App\Form;

use App\Entity\Tenues;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TenuesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_tn', TextType::class, [
                'label' => 'Nom tenue',
                'required' => true,
            ])
            ->add('numero_tn', TextType::class, [
                'label' => 'Numero tenue',
                'required' => true,
            ])
            ->add('abreviation_tn', TextType::class, [
                'label' => 'Abréviation tenue',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tenues::class,
        ]);
    }
}
