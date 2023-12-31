<?php

namespace App\Form;

use App\Entity\composant;
use App\Entity\Illustration;
use App\Entity\Traduction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('labeltrad')
            ->add('descriptiontrad')
            ->add('lang')
            ->add('composant', EntityType::class, [
                'class' => composant::class,
'choice_label' => 'id',
            ])
            ->add('illustration', EntityType::class, [
                'class' => Illustration::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Traduction::class,
        ]);
    }
}
