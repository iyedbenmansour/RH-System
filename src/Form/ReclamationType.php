<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Length;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userId', IntegerType::class, [
                'label' => 'User ID',
                'attr' => [
                    'min' => 1,
                    'class' => 'form-control',
                    'placeholder' => 'Enter the user ID'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'User ID cannot be empty'
                    ]),
                    new Positive([
                        'message' => 'User ID must be a positive number'
                    ])
                ]
            ])
            ->add('companyId', IntegerType::class, [
                'label' => 'Company ID',
                'attr' => [
                    'min' => 1,
                    'class' => 'form-control',
                    'placeholder' => 'Enter the company ID'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Company ID cannot be empty'
                    ]),
                    new Positive([
                        'message' => 'Company ID must be a positive number'
                    ])
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter the complaint title'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Title cannot be empty'
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 255,
                        'minMessage' => 'Title must contain at least {{ limit }} characters',
                        'maxMessage' => 'Title must not exceed {{ limit }} characters'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                    'placeholder' => 'Enter the detailed description of your complaint'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Description cannot be empty'
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Description must contain at least {{ limit }} characters'
                    ])
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image (JPG/PNG)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'image/jpeg,image/png'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid image (JPG or PNG)',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Maximum allowed size is {{ limit }} {{ suffix }}',
                    ])
                ],
            ])
            ->add('pdfFile', FileType::class, [
                'label' => 'PDF Document',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'application/pdf'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['application/pdf'],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Maximum allowed size is {{ limit }} {{ suffix }}',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
            'attr' => [
                'novalidate' => 'novalidate', // Disables native HTML5 validation
            ],
        ]);
    }
}