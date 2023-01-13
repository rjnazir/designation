<?php

namespace App\Form;

use App\Entity\Absences;
use App\Entity\Motifs;
use App\Entity\Personnels;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsencesType extends AbstractType
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
            ->add('motifs', EntityType::class, [
                'label' => 'Choisir le motif d\'absence',
                'class' => Motifs::class,
                'choice_label' => 'libelleMtf',
                'attr' => [
                    'class' => 'col-sm-12 form-control select'
                ],
                'required' => false,
            ])
            ->add('date_debut_abs', null, [
                'label' => 'Début d\'absence',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker',
                ],
                'required' => true,
            ])
            ->add('date_fin_abs', null, [
                'label' => 'Fin d\'absence',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker',
                ],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Absences::class,
        ]);
    }
}
