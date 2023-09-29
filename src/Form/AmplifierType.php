<?php

namespace App\Form;

use App\Entity\Amplifier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AmplifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('BrandId')
            ->add('UserId')
            ->add('Name')
            ->add('Height')
            ->add('OutputChannels')
            ->add('Power16')
            ->add('Power8')
            ->add('Power4')
            ->add('Power2')
            ->add('PowerBridge8')
            ->add('PowerBridge4')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Amplifier::class,
        ]);
    }
}
