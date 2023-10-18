<?php

namespace App\Form;

use App\Entity\Speaker;
use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SpeakerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'choice_label' => 'name',
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])
            ->add('Bandwidth', ChoiceType::class, [
                'choices'  => [
                    'Select Bandwidth' => 'NONE',
                    'Full Range' => 'FR',
                    'Subwoofer' => 'SUB',
                    'Low Fequency' => 'LF',
                    'Mid Fequency' => 'MF',
                    'High Fequency' => 'HF',
                ],
            ])
            ->add('Name', TextType::class, [
                'constraints' => [new NotBlank()]
            ])
            ->add('PowerRMS', IntegerType::class,[
                'label' => 'RMS Power',
                'constraints' => [new NotBlank()]
            ])
            ->add('PowerPeak', IntegerType::class,[
                'label' => 'Peak Power'
            ])
            ->add('Impedance', IntegerType::class, [
                'constraints' => [new NotBlank()]
            ])
            ->add('SPL', NumberType::class, [
                'label' => 'Sensitivity (SPL @ 1W 1m)',
                'required' => false,
            ])
            ->add('Manual', FileType::class, [
                'label' => 'Manual (PDF)',
                'mapped' => false, // not associated with any entity
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '25m',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'You can only upload PDF Files',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Speaker::class,
        ]);
    }
}
