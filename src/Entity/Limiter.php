<?php

namespace App\Entity;

use App\Repository\LimiterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: LimiterRepository::class)]
#[Broadcast]
class Limiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'limiters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'limiters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Processor $Processor = null;

    #[ORM\ManyToOne(inversedBy: 'limiters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Amplifier $Amplifier = null;

    #[ORM\ManyToOne(inversedBy: 'limiters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Speaker $Speaker = null;

    #[ORM\Column]
    private ?float $Vrms = null;

    #[ORM\Column]
    private ?float $Vpeak = null;

    #[ORM\Column]
    private ?float $VrmsValue = null;

    #[ORM\Column]
    private ?float $VpeakValue = null;

    #[ORM\Column(length: 255)]
    private ?string $VrmsAttack = null;

    #[ORM\Column(length: 255)]
    private ?string $VrmsRelease = null;

    #[ORM\Column(length: 255)]
    private ?string $VpeakAttack = null;

    #[ORM\Column(length: 255)]
    private ?string $VpeakRelease = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getProcessor(): ?Processor
    {
        return $this->Processor;
    }

    public function setProcessor(?Processor $Processor): static
    {
        $this->Processor = $Processor;

        return $this;
    }

    public function getAmplifier(): ?Amplifier
    {
        return $this->Amplifier;
    }

    public function setAmplifier(?Amplifier $Amplifier): static
    {
        $this->Amplifier = $Amplifier;

        return $this;
    }

    public function getSpeaker(): ?Speaker
    {
        return $this->Speaker;
    }

    public function setSpeaker(?Speaker $Speaker): static
    {
        $this->Speaker = $Speaker;

        return $this;
    }

    public function getVrms(): ?float
    {
        return $this->Vrms;
    }

    public function setVrms(float $Vrms): static
    {
        $this->Vrms = $Vrms;

        return $this;
    }

    public function getVpeak(): ?float
    {
        return $this->Vpeak;
    }

    public function setVpeak(float $Vpeak): static
    {
        $this->Vpeak = $Vpeak;

        return $this;
    }

    public function getVrmsValue(): ?float
    {
        return $this->VrmsValue;
    }

    public function setVrmsValue(float $VrmsValue): static
    {
        $this->VrmsValue = $VrmsValue;

        return $this;
    }

    public function getVpeakValue(): ?float
    {
        return $this->VpeakValue;
    }

    public function setVpeakValue(float $VpeakValue): static
    {
        $this->VpeakValue = $VpeakValue;

        return $this;
    }

    public function getVrmsAttack(): ?string
    {
        return $this->VrmsAttack;
    }

    public function setVrmsAttack(string $VrmsAttack): static
    {
        $this->VrmsAttack = $VrmsAttack;

        return $this;
    }

    public function getVrmsRelease(): ?string
    {
        return $this->VrmsRelease;
    }

    public function setVrmsRelease(string $VrmsRelease): static
    {
        $this->VrmsRelease = $VrmsRelease;

        return $this;
    }

    public function getVpeakAttack(): ?string
    {
        return $this->VpeakAttack;
    }

    public function setVpeakAttack(string $VpeakAttack): static
    {
        $this->VpeakAttack = $VpeakAttack;

        return $this;
    }

    public function getVpeakRelease(): ?string
    {
        return $this->VpeakRelease;
    }

    public function setVpeakRelease(string $VpeakRelease): static
    {
        $this->VpeakRelease = $VpeakRelease;

        return $this;
    }
}
