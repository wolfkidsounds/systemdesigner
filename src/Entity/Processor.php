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

    #[ORM\Column]
    private ?int $BrandId = null;

    #[ORM\Column]
    private ?int $UserId = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $Inputs = null;

    #[ORM\Column]
    private ?int $Outputs = null;

    #[ORM\Column(nullable: true)]
    private ?int $ProcessorOffset = null;

    #[ORM\Column(length: 255)]
    private ?string $Attachment = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $editedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandId(): ?int
    {
        return $this->BrandId;
    }

    public function setBrandId(int $BrandId): static
    {
        $this->BrandId = $BrandId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): static
    {
        $this->UserId = $UserId;

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

    public function getInputs(): ?int
    {
        return $this->Inputs;
    }

    public function setInputs(int $Inputs): static
    {
        $this->Inputs = $Inputs;

        return $this;
    }

    public function getOutputs(): ?int
    {
        return $this->Outputs;
    }

    public function setOutputs(int $Outputs): static
    {
        $this->Outputs = $Outputs;

        return $this;
    }

    public function getProcessorOffset(): ?int
    {
        return $this->ProcessorOffset;
    }

    public function setProcessorOffset(?int $ProcessorOffset): static
    {
        $this->ProcessorOffset = $ProcessorOffset;

        return $this;
    }

    public function getAttachment(): ?string
    {
        return $this->Attachment;
    }

    public function setAttachment(string $Attachment): static
    {
        $this->Attachment = $Attachment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeImmutable
    {
        return $this->editedAt;
    }

    public function setEditedAt(\DateTimeImmutable $editedAt): static
    {
        $this->editedAt = $editedAt;

        return $this;
    }
}
