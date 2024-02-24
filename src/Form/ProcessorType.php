<?php

namespace App\Form;

use App\Entity\Processor;
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

class ProcessorType extends AbstractType
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
            $manufacturers = $this->manufacturerRepository->findByUserOrValidated($this->user, 'processor');
        } else {
            $manufacturers = $this->manufacturerRepository->findBy(['User' => $this->user], [], 10);
        }

        $builder
            ->add('Manufacturer', EntityType::class, [
                'label' => false,
                'class' => Manufacturer::class,
                'choices' => $manufacturers,
                'choice_label' => 'name',
                'constraints' => [new NotBlank()],
                'attr' => [
                    'data-select' => 'true',
                    'placeholder' => new TranslatableMessage('Select Manufacturer') . '...',
                ],
            ])
            ->add('Name', TextType::class, [
                'label' => false,
                'constraints' => [new NotBlank()],
                'attr' => [
                    'placeholder' => new TranslatableMessage('Name') . '...',
                ],
            ])
            ->add('ChannelsInput', IntegerType::class, [
                'label' => false,
                'constraints' => [new NotBlank()],
                'attr' => [
                    'placeholder' => new TranslatableMessage('Inputs') . '...',
                ],
            ])
            ->add('ChannelsOutput', IntegerType::class, [
                'label' => false,
                'constraints' => [new NotBlank()],
                'attr' => [
                    'placeholder' => new TranslatableMessage('Outputs') . '...',
                ],
            ])
            ->add('OutputOffset', IntegerType::class, [
                'label' => false,
                'constraints' => [new NotBlank()],
                'attr' => [
                    'placeholder' => new TranslatableMessage('Output Offset') . '...',
                ],
            ])
            ->add('Manual', FileType::class, [
                'label' => false,
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
                'attr' => [
                    'placeholder' => new TranslatableMessage('Manual') . '...',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Processor::class,
        ]);
    }
}