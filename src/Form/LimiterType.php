<?php

namespace App\Form;

use App\Entity\Limiter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LimiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('UserId')
            ->add('Name')
            ->add('AmplifierId')
            ->add('ProcessorId')
            ->add('SpeakerId')
            ->add('PeakLimiter')
            ->add('RmsLimiter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Limiter::class,
        ]);
    }
}
