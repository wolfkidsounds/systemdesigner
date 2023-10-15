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
}
