<?php

namespace App\Form;

use App\Entity\Amplifier;
use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AmplifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'choice_label' => 'name',
                'constraints' => [new NotBlank()]
            ])
            ->add('Name', TextType::class, [
                'constraints' => [new NotBlank()]
            ])
            ->add('Power16', IntegerType::class,[
                'label' => 'Power @ 16Ω'
            ])
            ->add('Power8', IntegerType::class, [
                'label' => 'Power @ 8Ω'
            ])
            ->add('Power4', IntegerType::class, [
                'label' => 'Power @ 4Ω'
            ])
            ->add('Power2', IntegerType::class, [
                'label' => 'Power @ 2Ω'
            ])
            ->add('PowerBridge8', IntegerType::class, [
                'label' => 'Power Bridge @ 8Ω'
            ])
            ->add('PowerBridge4', IntegerType::class, [
                'label' => 'Power Bridge @ 4Ω'
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
            'data_class' => Amplifier::class,
        ]);
    }
}
