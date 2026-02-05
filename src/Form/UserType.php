<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'attr' => ['class' => 'form-control']
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom d\'affichage',
                'attr' => ['class' => 'form-control']
            ])
            ->add('bio', TextareaType::class, [
                'label' => 'Bio',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 5]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
