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
use Symfony\Component\Translation\TranslatableMessage;
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
                'label' => new TranslatableMessage('Manufacturer'),
                'class' => Manufacturer::class,
                'choice_label' => 'name',
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])
            ->add('Bandwidth', ChoiceType::class, [
                'label' => new TranslatableMessage('Bandwidth'),
                'choices'  => [
                    'Select Bandwidth' => new TranslatableMessage('NONE'),
                    'Full Range ( 20Hz - 20kHz )' => 'FR',
                    'Subwoofer ( < 200Hz )' => 'SUB',
                    'Low Fequency ( < 500Hz )' => 'LF',
                    'Mid Fequency ( 500Hz - 2kHz )' => 'MF',
                    'High Fequency ( > 2kHz )' => 'HF',
                ],
            ])
            ->add('Name', TextType::class, [
                'label' => new TranslatableMessage('Name'),
                'constraints' => [new NotBlank()]
            ])
            ->add('PowerRMS', IntegerType::class,[
                'label' => new TranslatableMessage('RMS Power'),
                'constraints' => [new NotBlank()]
            ])
            ->add('PowerPeak', IntegerType::class,[
                'label' => new TranslatableMessage('Peak Power'),
            ])
            ->add('Impedance', IntegerType::class, [
                'label' => new TranslatableMessage('Impedance'),
                'constraints' => [new NotBlank()]
            ])
            ->add('SPL', NumberType::class, [
                'label' => new TranslatableMessage('Sensitivity (SPL @ 1W 1m)'),
                'required' => false,
            ])
            ->add('Manual', FileType::class, [
                'label' => new TranslatableMessage('Manual (PDF)'),
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
