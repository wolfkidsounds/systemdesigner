<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Chassis;
use App\Entity\Speaker;
use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use App\Repository\ManufacturerRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ChassisType extends AbstractType
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
            $manufacturers = $this->manufacturerRepository->findByUserOrValidated($this->user, 'chassis');
        } else {
            $manufacturers = $this->manufacturerRepository->findBy(['User' => $this->user], [], 10);
        }

        $builder
        // Basic Information
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

        // General Parameters
            ->add('NominalImpedance', NumberType::class, [
                'label' => new TranslatableMessage('Nominal Impedance'),
                'attr' => ['placeholder' => 'Nominal Impedance'],
            ])

            ->add('PowerRMS', NumberType::class, [
                'label' => new TranslatableMessage('Power RMS'),
                'attr' => ['placeholder' => 'Power RMS'],
            ])

            ->add('Sensitivity', NumberType::class, [
                'label' => new TranslatableMessage('Sensitivity'),
                'attr' => ['placeholder' => 'Sensitivity'],
            ])

        // Thiele/Small Parameters

        // Electrical Parameters
            ->add('Fs', NumberType::class, [
                'label' => new TranslatableMessage('Resonance Frequency (Fs)'),
                'attr' => ['placeholder' => 'Resonance Frequency'],
            ])

            ->add('Re', NumberType::class, [
                'label' => new TranslatableMessage('DC Resistance (Re)'),
                'attr' => ['placeholder' => 'DC Resistance'],
            ])

            ->add('Le', NumberType::class, [
                'label' => new TranslatableMessage('Voice Coil Inductance (Le)'),
                'attr' => ['placeholder' => 'Voice Coil Inductance'],
            ])

            ->add('Qes', NumberType::class, [
                'label' => new TranslatableMessage('Electrical Grade (Qes)'),
                'attr' => ['placeholder' => 'Electrical Grade'],
            ])

        // Mechanical Parameters
            ->add('Qms', NumberType::class, [
                'label' => new TranslatableMessage('Mechanical Grade (Qms)'),
                'attr' => ['placeholder' => 'Mechanical Grade'],
            ])

            ->add('Vas', NumberType::class, [
                'label' => new TranslatableMessage('Equivalent Volume of Compliance (Cms)'),
                'attr' => ['placeholder' => 'Equivalent Volume of Compliance'],
            ])

            ->add('Sd', NumberType::class, [
                'label' => new TranslatableMessage('Effective Piston Area (Sd)'),
                'attr' => ['placeholder' => 'Effective Piston Area'],
            ])

            ->add('Xmax', NumberType::class, [
                'label' => new TranslatableMessage('Maximum Linear Excursion (Xmax)'),
                'attr' => ['placeholder' => 'Maximum Linear Excursion'],
            ])

            ->add('Mms', NumberType::class, [
                'label' => new TranslatableMessage('Moving Mass (Mms)'),
                'attr' => ['placeholder' => 'Moving Mass'],
            ])

            ->add('Mmd', NumberType::class, [
                'label' => new TranslatableMessage('Diaphragm Mass (Mmd)'),
                'attr' => ['placeholder' => 'Diaphragm Mass'],
            ])

            ->add('Cms', NumberType::class, [
                'label' => new TranslatableMessage('Compliance of Suspension (Cms)'),
                'attr' => ['placeholder' => 'Compliance of Suspension'],
            ])

            ->add('Rms', NumberType::class, [
                'label' => new TranslatableMessage('Mechanical Resistance (Rms)'),
                'attr' => ['placeholder' => 'Mechanical Resistance'],
            ])
            ->add('Bl', NumberType::class, [
                'label' => new TranslatableMessage('Bl Product (Bl)'),
                'attr' => ['placeholder' => 'Bl Product'],
            ])

        // Additional Parameters
            ->add('Qts', NumberType::class, [
                'label' => new TranslatableMessage('Total Grade (Qts)'),
                'attr' => ['placeholder' => 'Total Grade'],
            ])
            
            ->add('Vd', NumberType::class, [
                'label' => new TranslatableMessage('Displacement Volume (Vd)'),
                'attr' => ['placeholder' => 'Displacement Volume'],
            ])
            ->add('VoiceCoilDiameter', NumberType::class, [
                'label' => new TranslatableMessage('Voice Coil Diameter'),
                'attr' => ['placeholder' => 'Voice Coil Diameter'],
            ])
            ->add('WindingMaterial', ChoiceType::class, [
                'label' => new TranslatableMessage('Winding Material'),
                'choices' => [
                    'Copper (Cu)' => 'copper',
                ],
                'attr' => ['placeholder' => 'Winding Material'],
                'constraints' => [new NotBlank()],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chassis::class,
        ]);
    }
}
