<?php

namespace App\Form;

use App\Entity\ReponseReclamation;
use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ReponseReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reclamation', EntityType::class, [
                'class' => Reclamation::class,
                'label' => 'Complaint',
                'choice_label' => function (Reclamation $reclamation) {
                    return sprintf('#%d - %s', $reclamation->getId(), $reclamation->getTitle());
                },
                'placeholder' => 'Select a complaint',
                'attr' => [
                    'class' => 'form-control select2'
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.id', 'DESC');
                },
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a complaint'
                    ])
                ]
            ])
            ->add('idUser', IntegerType::class, [
                'label' => 'User ID',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
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
            ->add('idReceiver', IntegerType::class, [
                'label' => 'Recipient ID',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'placeholder' => 'Enter the recipient ID'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Recipient ID cannot be empty'
                    ]),
                    new Positive([
                        'message' => 'Recipient ID must be a positive number'
                    ])
                ]
            ])
            ->add('reponse', TextareaType::class, [
                'label' => 'Response',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                    'placeholder' => 'Enter your response (minimum 10 characters)'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Response cannot be empty'
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Response must contain at least {{ limit }} characters'
                    ])
                ]
            ])
            ->add('pdfFile', FileType::class, [
                'label' => 'PDF File (optional)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF file',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Maximum allowed size is {{ limit }} {{ suffix }}',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'application/pdf'
                ],
                'help' => 'You can attach a PDF document (invoice, proof, etc.). Maximum size: 5 MB.'
            ])
            ->add('statueOfReponseReclamation', ChoiceType::class, [
                'label' => 'Status',
                'choices' => [
                    'Pending' => 'Pending',
                    'Processed' => 'Processed',
                    'Closed' => 'Closed',
                    'Rejected' => 'Rejected'
                ],
                'attr' => [
                    'class' => 'form-select'
                ],
                'data' => 'Pending',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Status cannot be empty'
                    ])
                ]
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'required' => true,
                'data' => new \DateTime(),
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReponseReclamation::class,
            'attr' => [
                'novalidate' => 'novalidate', // Disables native HTML5 validation
            ],
        ]);
    }
}
