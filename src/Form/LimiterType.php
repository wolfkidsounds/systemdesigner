<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Limiter;
use App\Entity\Speaker;
use App\Entity\Amplifier;
use App\Entity\Processor;
use App\Repository\SpeakerRepository;
use App\Repository\AmplifierRepository;
use App\Repository\ProcessorRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LimiterType extends AbstractType
{
    /** @var User $user */
    private $user;
    private $processorRepository;
    private $amplifierRepository;
    private $speakerRepository;

    public function __construct(TokenStorageInterface $tokenStorage, ProcessorRepository $processorRepository, AmplifierRepository $amplifierRepository, SpeakerRepository $speakerRepository) {
        $this->user = $tokenStorage->getToken()->getUser();
        $this->processorRepository = $processorRepository;
        $this->amplifierRepository = $amplifierRepository;
        $this->speakerRepository = $speakerRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->user->isSubscriber() && $this->user->isDatabaseAccessEnabled()) {
            $processors = $this->processorRepository->findByUserOrValidated($this->user);
            $amplifiers = $this->amplifierRepository->findByUserOrValidated($this->user);
            $speakers = $this->speakerRepository->findByUserOrValidated($this->user);      
        } else {
            $processors = $this->processorRepository->findBy(['User' => $this->user], [], 10);
            $amplifiers = $this->amplifierRepository->findBy(['User' => $this->user], [], 10);
            $speakers = $this->speakerRepository->findBy(['User' => $this->user], [], 10);
        }

        $builder
            ->add('Processor', EntityType::class, [
                'class' => Processor::class,
                'choices' => $processors,
                'constraints' => [new NotBlank()],
                'attr' => [ 'data-select' => 'true' ]
            ])

            ->add('Amplifier', EntityType::class, [
                'class' => Amplifier::class,
                'choices' => $amplifiers,
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])

            ->add('Speaker', EntityType::class, [
                'class' => Speaker::class,
                'choices' => $speakers,
                'constraints' => [new NotBlank()],
                'attr' => ['data-select' => 'true']
            ])

            ->add('Vrms', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true],
            ])

            ->add('VrmsValue', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('VrmsAttack', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('VrmsRelease', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('Vpeak', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('VpeakValue', NumberType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('VpeakAttack', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('VpeakRelease', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['readonly' => true]
            ])

            ->add('BridgeModeEnabled', ChoiceType::class, [
                'label' => 'Bridge Mode Enabled',
                'choices'  => [
                    'Disabled' => false,
                    'Enabled' => true,
                ],
            ])

            ->add('InputSensitivity', NumberType::class, [
                'label' => 'Input Sensitivity',
                'attr' => ['readonly' => false],
            ])

            ->add('SpeakersInParallel', NumberType::class, [
                'label' => 'Speakers in Parallel'
            ])

            ->add('Scaling', PercentType::class, [
                'label' => 'Limiter Scaling',
                'attr' => [
                    'min' => 1,
                    'max' => 100,
                ]
            ])

            ->add('Algorithm', ChoiceType::class, [
                'label' => 'Calculation Algorithm',
                'choices'  => [
                    'System Designer' => 'system_designer',
                    //'True Power' => 'true_power',
                    //'Power vs. RMS' => 'power_vs_rms',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Limiter::class,
        ]);
    }
}
