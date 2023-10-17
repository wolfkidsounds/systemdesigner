<?php

namespace App\Form;

use App\Entity\Limiter;
use App\Entity\Speaker;
use App\Entity\Amplifier;
use App\Entity\Processor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LimiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Processor', EntityType::class, [
                'class' => Processor::class,
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])
            ->add('Amplifier', EntityType::class, [
                'class' => Amplifier::class,
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])
            ->add('Speaker', EntityType::class, [
                'class' => Speaker::class,
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])
            ->add('Vrms', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('VrmsValue', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('VrmsAttack', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('VrmsRelease', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('Vpeak', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('VpeakValue', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('VpeakAttack', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
            ->add('VpeakRelease', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Limiter::class,
        ]);
    }
}
