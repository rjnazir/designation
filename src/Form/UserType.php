<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'label' => 'Nom d\'utilisateur',
            'required' => true,
        ])
        ->add('roles', ChoiceType::class, [
            'choices' => [
                'Administrateur'=> 'ROLE_ADMIN',
                'Utilisateur'   => 'ROLE_USER',
                'Consultation'  => 'ROLE_STAFF',
            ],
            'label' => 'Rôle de l\'utilisateur',
            'required' => true,
            'expanded' => false,
            'multiple' => true,
            'attr'  => [
                'class' => 'form-control select',
                // 'class' => 'col-sm-12 form-control select2-selection--multiple text-uppercase'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe sont différents.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label' => 'Entrer votre mot de passe'],
            'second_options' => ['label' => 'Rétaper votre mot de passe'],
        ])
        ->add('isActive', CheckboxType::class, [
            'label'=>'Est activé?',
            'required'  => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
