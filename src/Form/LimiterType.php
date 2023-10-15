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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Limiter::class,
        ]);
    }
}
