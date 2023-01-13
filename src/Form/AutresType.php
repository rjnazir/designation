<?php

namespace App\Form;

use App\Entity\Autres;
use App\Entity\Personnels;
use App\Entity\Services;
use App\Entity\TypesServices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


class AutresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('personnels', EntityType::class, [
                'label' => 'Choisir le personnel',
                'class' => Personnels::class,
                'attr' => [
                    'class' => 'col-sm-12 form-control select'
                ],
                'query_builder' => function (EntityRepository $_er){
                        return $_er
                            ->createQueryBuilder('c')
                            ->where("c.is_out_cr = 0");
                },
                'choice_label' => 'InZoneDeListe',
                'required' => false,
            ])
           /* ->add('services', EntityType::class, [
                'label' => 'Services',
                'class' => Services::class,
                'attr' => [
                    'class' => 'col-sm-12 form-control select'
                ],
                'query_builder' => function (EntityRepository $_er){
                        return $_er
                            ->createQueryBuilder('c')
                            ->join('c.services_id', 'd')->addSelect('d')
                            ->where("c.types_service= 1");
                },
                'choice_label' => 'nomSce',
                'required' => false,
            ])            
            /*->add('services', EntityType::class, [
                'label' => 'Services',
                'class' => Services::class,
                'choice_label' => 'nomSce',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])*/
            ->add('services', EntityType::class, [
                'label' => 'Services',
                'class' => Services::class,
                'choice_label' => 'nomSce',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Autres::class,
        ]);
    }
}
