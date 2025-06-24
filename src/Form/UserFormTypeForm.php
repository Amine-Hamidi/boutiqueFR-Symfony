<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserFormTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=>'Entrez votre prénom',
                'attr'=>
                [
                    'placeholder'=>"Indiquez votre prénom"
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=>'Entrez votre nom',
                'attr'=>
                [
                    'placeholder'=>"Indiquez votre nom"
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=>'Entrez votre adresse mail',
                'attr'=>
                [
                    'placeholder'=>"Indiquez votre email"
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' =>
                [
                    new Length(
                    [
                        'min' => 6,
                        'max' => 30
                   ])
                ],
                'first_options'  =>
                    [
                        'label'=>'Entrez votre mot de passe',
                        'attr'=>
                        [
                            'placeholder'=>"Choisissez votre mot de passe"
                        ],
                        'hash_property_path' => 'password'
                    ],
                'second_options' =>
                [
                        'label'=>'Confirmez votre mot de passe',
                        'attr'=>
                        [
                            'placeholder'=>"Confirmez votre mot de passe"
                        ]
                ],
                'mapped' => false,
            ])
                ->add('submit', SubmitType::class,[
                'label'=>"S'inscrire",
                'attr'=>[
                    'class'=>"btn btn-success"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints'=> [
                new UniqueEntity([
                    'entityClass'=> User::class,
                    'fields' => 'email'
                ])
            ],
            'data_class' => User::class,
        ]);
    }
}
