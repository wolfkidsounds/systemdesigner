<?php

namespace App\Form;

use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
                'label' => false,
                'constraints' => [new NotBlank()],
                'attr' => [
                    'placeholder' => new TranslatableMessage('Name') . '...',
                ],
            ])

            ->add('Category', ChoiceType::class, [
                'label' => false,
                'constraints' => [new NotBlank()],
                'multiple' => true,
                'attr' => [
                    'data-select' => 'true',
                    'placeholder' => new TranslatableMessage('Category') . '...',
                ],
                'choices' => [
                    'Amplifier' => 'amplifier',
                    'Processor' => 'processor',
                    'Speaker' => 'speaker',
                    'Chassis' => 'chassis',
                ],
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
