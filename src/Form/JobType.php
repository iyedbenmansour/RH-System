<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'rows' => 5]
            ])
            ->add('companyId', IntegerType::class, [
                'label' => 'Company ID',
                'attr' => ['class' => 'form-control']
            ])
            ->add('position', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('location', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('postedDate', DateTimeType::class, [
                'disabled' => true,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'readonly' => true
                ],
                'label' => 'Posted Date',
                'data' => new \DateTime(), // Default value
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}