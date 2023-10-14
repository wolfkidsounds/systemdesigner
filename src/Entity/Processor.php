<?php

namespace App\Entity;

use App\Repository\ProcessorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ProcessorRepository::class)]
#[Broadcast]
class Processor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $ChannelsInput = null;

    #[ORM\Column]
    private ?int $ChannelsOutput = null;

    #[ORM\Column]
    private ?int $OutputOffset = null;

    #[ORM\ManyToOne(inversedBy: 'processors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'processors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $Manufacturer = null;

    #[ORM\Column]
    private ?bool $Validated = false;

    public function __toString() {
        return $this->Manufacturer . ' - ' . $this->Name;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChannelsInput(): ?int
    {
        return $this->ChannelsInput;
    }

    public function setChannelsInput(int $ChannelsInput): static
    {
        $this->ChannelsInput = $ChannelsInput;

        return $this;
    }

    public function getChannelsOutput(): ?int
    {
        return $this->ChannelsOutput;
    }

    public function setChannelsOutput(int $ChannelsOutput): static
    {
        $this->ChannelsOutput = $ChannelsOutput;

        return $this;
    }

    public function getOutputOffset(): ?int
    {
        return $this->OutputOffset;
    }

    public function setOutputOffset(int $OutputOffset): static
    {
        $this->OutputOffset = $OutputOffset;

        return $this;
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

    public function isValidated(): ?bool
    {
        return $this->Validated;
    }

    public function setValidated(bool $Validated): static
    {
        $this->Validated = $Validated;

        return $this;
    }
}
