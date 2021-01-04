<?php

namespace App\Form;

use App\Entity\Concert;
use App\Entity\Hall;
use App\Entity\Band;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy'
            ])
            ->add('tour_name', TextType::class, [
                'label' => 'Nom de la tournée'
            ])
            ->add('band', EntityType::class, [
                'class' => Band::class,
                'choice_label' => 'name',
                'label' => 'Band'
            ])
            ->add('hall', EntityType::class, [
                'class' => Hall::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concert::class,
        ]);
    }
}
