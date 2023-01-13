<?php

namespace App\Form;

use App\Entity\Motifs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MotifsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle_mtf', TextType::class, [
                'label' => 'Libellé du motif',
                'required' => true,
            ])
            ->add('abreviation_mtf', TextType::class, [
                'label' => 'Abréviation du motif',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Motifs::class,
        ]);
    }
}
