<?php

namespace App\Entity;

use App\Repository\AmplifierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AmplifierRepository::class)]
#[Broadcast]
class Amplifier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'amplifiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'amplifiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $Manufacturer = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(nullable: true)]
    private ?int $Power16 = null;

    #[ORM\Column(nullable: true)]
    private ?int $Power8 = null;

    #[ORM\Column(nullable: true)]
    private ?int $Power4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $Power2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $PowerBridge8 = null;

    #[ORM\Column(nullable: true)]
    private ?int $PowerBridge4 = null;

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

    public function getPower16(): ?int
    {
        return $this->Power16;
    }

    public function setPower16(?int $Power16): static
    {
        $this->Power16 = $Power16;

        return $this;
    }

    public function getPower8(): ?int
    {
        return $this->Power8;
    }

    public function setPower8(?int $Power8): static
    {
        $this->Power8 = $Power8;

        return $this;
    }

    public function getPower4(): ?int
    {
        return $this->Power4;
    }

    public function setPower4(?int $Power4): static
    {
        $this->Power4 = $Power4;

        return $this;
    }

    public function getPower2(): ?int
    {
        return $this->Power2;
    }

    public function setPower2(?int $Power2): static
    {
        $this->Power2 = $Power2;

        return $this;
    }

    public function getPowerBridge8(): ?int
    {
        return $this->PowerBridge8;
    }

    public function setPowerBridge8(?int $PowerBridge8): static
    {
        $this->PowerBridge8 = $PowerBridge8;

        return $this;
    }

    public function getPowerBridge4(): ?int
    {
        return $this->PowerBridge4;
    }

    public function setPowerBridge4(?int $PowerBridge4): static
    {
        $this->PowerBridge4 = $PowerBridge4;

        return $this;
    }
}
