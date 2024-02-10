<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Amplifier;
use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use App\Repository\ManufacturerRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AmplifierType extends AbstractType
{
    /** @var User $user */
    private $user;
    private $manufacturerRepository;

    public function __construct(TokenStorageInterface $tokenStorage, ManufacturerRepository $manufacturerRepository) {
        $this->user = $tokenStorage->getToken()->getUser();
        $this->manufacturerRepository = $manufacturerRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->user->isSubscriber() && $this->user->isDatabaseAccessEnabled()) {
            $manufacturers = $this->manufacturerRepository->findByUserOrValidatedWithCategory($this->user, 'amplifier');
        } else {
            $manufacturers = $this->manufacturerRepository->findBy(['User' => $this->user, 'Category' => 'amplifier'], [], 10);
        }

        $builder
            ->add('Manufacturer', EntityType::class, [
                'label' => new TranslatableMessage('Manufacturer'),
                'class' => Manufacturer::class,
                'choices' => $manufacturers,
                'choice_label' => 'name',
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])
            ->add('Name', TextType::class, [
                'label' => new TranslatableMessage('Name'),
                'constraints' => [new NotBlank()]
            ])
            ->add('Power16', IntegerType::class,[
                'label' => new TranslatableMessage('Power') . ' @ 16Ω',
            ])
            ->add('Power8', IntegerType::class, [
                'label' => new TranslatableMessage('Power') . ' @ 8Ω',
            ])
            ->add('Power4', IntegerType::class, [
                'label' => new TranslatableMessage('Power') . ' @ 4Ω',
            ])
            ->add('Power2', IntegerType::class, [
                'label' => new TranslatableMessage('Power') . ' @ 2Ω',
            ])
            ->add('PowerBridge8', IntegerType::class, [
                'label' => new TranslatableMessage('Power Bridged') . ' @ 8Ω',
            ])
            ->add('PowerBridge4', IntegerType::class, [
                'label' => new TranslatableMessage('Power Bridged') . ' @ 4Ω',
            ])
            ->add('Manual', FileType::class, [
                'label' => new TranslatableMessage('Manual (PDF)'),
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
