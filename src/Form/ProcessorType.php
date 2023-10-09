<?php

namespace App\Form;

use App\Entity\Processor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcessorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('Manufacturer')
            ->add('ChannelsInput')
            ->add('ChannelsOutput')
            ->add('OutputOffset')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Processor::class,
        ]);
    }
}