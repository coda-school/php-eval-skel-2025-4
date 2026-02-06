<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // <-- Ajoute cette ligne
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class KweekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ContenuDuKweek', TextareaType::class, [ // <-- Utilise TextareaType ici
                'label' => false, // On cache le label par défaut
                'attr' => [
                    'rows' => 6, // Définit la hauteur par défaut
                    'placeholder' => "What's happening?" // Placeholder déplacé ici (plus propre)
                ]
            ])
            /*->add('thumbnailFile', FileType::class, [
                'mapped' => false,
                'constraints' => [
                    new Image()
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
