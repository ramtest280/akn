<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control mb-2',
                ]
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Prenom',
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('birth', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('fathername', TextType::class, [
                'label' => 'Nom du pere',
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ] )
            ->add('mothername', TextType::class, [
                'label' => 'Nom de la mere',
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Photo de l\'eleve', 
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
