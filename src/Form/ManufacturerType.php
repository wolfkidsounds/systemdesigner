<?php

namespace App\Form;

use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ManufacturerType extends AbstractType
{
    public function __construct (
        private Security $security
    ) {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => new TranslatableMessage('Name'),
                'constraints' => [new NotBlank()]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Manufacturer::class,
        ]);
    }
}
