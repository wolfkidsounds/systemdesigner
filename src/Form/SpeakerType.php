<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Chassis;
use App\Entity\Speaker;
use App\Entity\Manufacturer;
use App\Repository\ChassisRepository;
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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SpeakerType extends AbstractType
{
    /** @var User $user */
    private $user;
    private $manufacturerRepository;
    private $chassisRepository;

    public function __construct(TokenStorageInterface $tokenStorage, ManufacturerRepository $manufacturerRepository, ChassisRepository $chassisRepository) {
        $this->user = $tokenStorage->getToken()->getUser();
        $this->manufacturerRepository = $manufacturerRepository;
        $this->chassisRepository = $chassisRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->user->isSubscriber() && $this->user->isDatabaseAccessEnabled()) {
            $manufacturers = $this->manufacturerRepository->findByUserOrValidatedWithCategory($this->user, 'amplifier');
            $chassis = $this->chassisRepository->findByUserOrValidated($this->user);
        } else {
            $manufacturers = $this->manufacturerRepository->findBy(['User' => $this->user], [], 10);
            $chassis = $this->chassisRepository->findBy(['User' => $this->user], [], 10);
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

            ->add('Chassis', EntityType::class, [
                'label' => new TranslatableMessage('Chassis'),
                'class' => Chassis::class,
                'choices' => $chassis,
                'attr' => ['data-select' => 'true'],
                'multiple' => true
            ])

            ->add('Bandwidth', ChoiceType::class, [
                'label' => new TranslatableMessage('Bandwidth'),
                'choices'  => [
                    'Select Bandwidth' => new TranslatableMessage('NONE'),
                    'Full Range ( 20Hz - 20kHz )' => 'FR',
                    'Subwoofer ( < 200Hz )' => 'SUB',
                    'Low Fequency ( < 500Hz )' => 'LF',
                    'Mid Fequency ( 500Hz - 2kHz )' => 'MF',
                    'High Fequency ( > 2kHz )' => 'HF',
                ],
            ])
            ->add('Name', TextType::class, [
                'label' => new TranslatableMessage('Name'),
                'constraints' => [new NotBlank()]
            ])
            ->add('PowerRMS', IntegerType::class,[
                'label' => new TranslatableMessage('RMS Power'),
                'constraints' => [new NotBlank()]
            ])
            ->add('PowerPeak', IntegerType::class,[
                'label' => new TranslatableMessage('Peak Power'),
            ])
            ->add('Impedance', IntegerType::class, [
                'label' => new TranslatableMessage('Impedance'),
                'constraints' => [new NotBlank()]
            ])
            ->add('SPL', NumberType::class, [
                'label' => new TranslatableMessage('Sensitivity (SPL @ 1W 1m)'),
                'required' => false,
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
            'data_class' => Speaker::class,
        ]);
    }
}
