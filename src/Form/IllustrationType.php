<?php

namespace App\Form;

use App\Entity\Illustration;
use App\Entity\theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IllustrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('defaultlang', ChoiceType::class, [
                'label' => 'Langue',
                'choices' => [
                    'Français' => 'fr',
                    'Anglais' => 'en',
                    'Espagnol' => 'es',
                    'Portugais' => 'pt',
                    'Italien' => 'it',
                    'Chinois' => 'zh',
                    'Japonais' => 'ja',
                ],
                'placeholder' => 'Choisissez une langue',
                'required' => true,
            ])
            ->add('imgsrc', FileType::class, [
                'label' => 'Image illustrée',
              'required' => true,
              'mapped' => false,
            ])
            ->add('description')
            ->add('theme', EntityType::class, [
                                'class' => theme::class,
                'choice_label' => 'titre',
                            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Illustration::class,
        ]);
    }
}
