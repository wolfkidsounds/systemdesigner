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
    private ?string $Brand = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $ChannelsInput = null;

    #[ORM\Column]
    private ?int $ChannelsOutput = null;

    #[ORM\Column]
    private ?int $OutputOffset = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): static
    {
        $this->Brand = $Brand;

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
}
