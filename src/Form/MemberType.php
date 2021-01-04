<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Band;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('first_name', TextType::class, [
                'label' => 'First_name'
            ])
            ->add('job', TextType::class, [
                'label' => 'Job'
            ])
            ->add('birth_date', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy'
            ])
            ->add('picture', TextType::class, [
                'label' => 'Path'
            ])
            ->add('band', EntityType::class, [
                'class' => Band::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
