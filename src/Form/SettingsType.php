<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('Locale', ChoiceType::class, [
                'label' => new TranslatableMessage('Language'),
                'choices' => [
                    'English' => 'en',
                    'German' => 'de',
                ]
            ])

            ->add('DatabaseAccess', ChoiceType::class, [
                'label' => new TranslatableMessage('Show All Items'),
                'choices' => [
                    'Disabled' => false,
                    'Enabled' => true,
                ]
            ])

            ->add('ShowBetaFeatures', ChoiceType::class, [
                'label' => new TranslatableMessage('Show Beta Features'),
                'choices' => [
                    'Disabled' => false,
                    'Enabled' => true,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
