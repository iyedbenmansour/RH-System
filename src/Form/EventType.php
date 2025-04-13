<?php
// src/Form/EventType.php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 5]
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('location', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('organiser', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('eventType', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('nbParticipant', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('ticketPrice', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('hasFormation', CheckboxType::class, [
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            ->add('formationId', NumberType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('longitude', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('latitude', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}