<?php

namespace App\Form;

use App\Entity\Designations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use DateTime;
use Doctrine\ORM\EntityRepository;
use App\Entity\Personnels;
use App\Entity\Transports;
use App\Entity\Munitions;
use App\Entity\TypeArmements;
use App\Entity\Tenues;
use App\Entity\Services;

class DesignationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_depart_design', null, [
                'label' => 'Date départ',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker',
                ],
                'required' => true,
            ])   
            ->add('date_retour_design', null, [
                'label' => 'Date retour',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker',
                ],
                'required' => true,
            ])                       
            ->add('distance')
            ->add('itineraire')
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
            ->add('transports', EntityType::class, [
                'label' => 'Transport',
                'class' => Transports::class,
                'choice_label' => 'nomTransp',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
            ->add('munitions', EntityType::class, [
                'label' => 'Munitions',
                'class' => Munitions::class,
                'choice_label' => 'calibreMun',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
            ->add('type_armements', EntityType::class, [
                'label' => 'Type armement',
                'class' => TypeArmements::class,
                'choice_label' => 'nomArm',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
            ->add('tenues', EntityType::class, [
                'label' => 'Tenues',
                'class' => Tenues::class,
                'choice_label' => 'nomTn',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
            ->add('services', EntityType::class, [
                'label' => 'Services',
                'class' => Services::class,
                'choice_label' => 'nomSce',
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
            ])
            ->add('ordre_speciaux', TextareaType::class, [
                'label' => 'Ordres spéciaux',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Designations::class,
        ]);
    }
}
