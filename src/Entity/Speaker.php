<?php

namespace App\Entity;

use App\Repository\SpeakerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: SpeakerRepository::class)]
#[Broadcast]
class Speaker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'speakers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'speakers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $Manufacturer = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $PowerRMS = null;

    #[ORM\Column(nullable: true)]
    private ?int $PowerPeak = null;

    #[ORM\Column]
    private ?int $Impedance = null;

    #[ORM\Column(nullable: true)]
    private ?float $SPL = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Manual = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $Validated = false;

    #[ORM\Column(length: 255)]
    private ?string $Bandwidth = null;

    public function __toString() {
        return $this->Manufacturer . ' - ' . $this->Name;
    }

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

    public function getManufacturer(): ?Manufacturer
    {
        return $this->Manufacturer;
    }

    public function setManufacturer(?Manufacturer $Manufacturer): static
    {
        $this->Manufacturer = $Manufacturer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPowerRMS(): ?int
    {
        return $this->PowerRMS;
    }

    public function setPowerRMS(int $PowerRMS): static
    {
        $this->PowerRMS = $PowerRMS;

        return $this;
    }

    public function getPowerPeak(): ?int
    {
        return $this->PowerPeak;
    }

    public function setPowerPeak(?int $PowerPeak): static
    {
        $this->PowerPeak = $PowerPeak;

        return $this;
    }

    public function getImpedance(): ?int
    {
        return $this->Impedance;
    }

    public function setImpedance(int $Impedance): static
    {
        $this->Impedance = $Impedance;

        return $this;
    }

    public function getSPL(): ?float
    {
        return $this->SPL;
    }

    public function setSPL(?float $SPL): static
    {
        $this->SPL = $SPL;

        return $this;
    }

    public function getManual(): ?string
    {
        return $this->Manual;
    }

    public function setManual(?string $Manual): static
    {
        $this->Manual = $Manual;

        return $this;
    }

    public function isValidated(): ?bool
    {
        return $this->Validated;
    }

    public function setValidated(bool $Validated): static
    {
        $this->Validated = $Validated;

        return $this;
    }

    public function getBandwidth(): ?string
    {
        return $this->Bandwidth;
    }

    public function setBandwidth(string $Bandwidth): static
    {
        $this->Bandwidth = $Bandwidth;

        return $this;
    }
}
