<?php

namespace App\Form;

use App\Entity\Amplifier;
use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            ->add('Power16', IntegerType::class)
            ->add('Power8', IntegerType::class)
            ->add('Power4', IntegerType::class)
            ->add('Power2', IntegerType::class)
            ->add('PowerBridge8', IntegerType::class)
            ->add('PowerBridge4', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Amplifier::class,
        ]);
    }
}
