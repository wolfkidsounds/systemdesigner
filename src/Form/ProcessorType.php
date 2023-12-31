<?php

namespace App\Form;

use App\Entity\Processor;
use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProcessorType extends AbstractType
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
            ->add('Name', TextType::class, [
                'label' => new TranslatableMessage('Name'),
                'constraints' => [new NotBlank()]
            ])
            ->add('ChannelsInput', IntegerType::class, [
                'label' => new TranslatableMessage('Inputs'),
                'constraints' => [new NotBlank()]
            ])
            ->add('ChannelsOutput', IntegerType::class, [
                'label' => new TranslatableMessage('Outputs'),
                'constraints' => [new NotBlank()]
            ])
            ->add('OutputOffset', IntegerType::class, [
                'label' => new TranslatableMessage('Offset'),
                'constraints' => [new NotBlank()]                
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
            'data_class' => Processor::class,
        ]);
    }
}