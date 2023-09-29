<?php

namespace App\Entity;

use App\Repository\SpeakerRepository;
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

    #[ORM\Column]
    private ?int $BrandId = null;

    #[ORM\Column]
    private ?int $UserId = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Bandwidth = null;

    #[ORM\Column]
    private ?int $PowerRms = null;

    #[ORM\Column]
    private ?int $Impedance = null;

    #[ORM\Column]
    private ?float $Spl = null;

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

    public function getBandwidth(): ?string
    {
        return $this->Bandwidth;
    }

    public function setBandwidth(string $Bandwidth): static
    {
        $this->Bandwidth = $Bandwidth;

        return $this;
    }

    public function getPowerRms(): ?int
    {
        return $this->PowerRms;
    }

    public function setPowerRms(int $PowerRms): static
    {
        $this->PowerRms = $PowerRms;

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

    public function getSpl(): ?float
    {
        return $this->Spl;
    }

    public function setSpl(float $Spl): static
    {
        $this->Spl = $Spl;

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
