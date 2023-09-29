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

    #[ORM\Column]
    private ?int $UserId = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $AmplifierId = null;

    #[ORM\Column]
    private ?int $ProcessorId = null;

    #[ORM\Column]
    private ?int $SpeakerId = null;

    #[ORM\Column]
    private ?float $PeakLimiter = null;

    #[ORM\Column]
    private ?float $RmsLimiter = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $editedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmplifierId(): ?int
    {
        return $this->AmplifierId;
    }

    public function setAmplifierId(int $AmplifierId): static
    {
        $this->AmplifierId = $AmplifierId;

        return $this;
    }

    public function getProcessorId(): ?int
    {
        return $this->ProcessorId;
    }

    public function setProcessorId(int $ProcessorId): static
    {
        $this->ProcessorId = $ProcessorId;

        return $this;
    }

    public function getSpeakerId(): ?int
    {
        return $this->SpeakerId;
    }

    public function setSpeakerId(int $SpeakerId): static
    {
        $this->SpeakerId = $SpeakerId;

        return $this;
    }

    public function getPeakLimiter(): ?float
    {
        return $this->PeakLimiter;
    }

    public function setPeakLimiter(float $PeakLimiter): static
    {
        $this->PeakLimiter = $PeakLimiter;

        return $this;
    }

    public function getRmsLimiter(): ?float
    {
        return $this->RmsLimiter;
    }

    public function setRmsLimiter(float $RmsLimiter): static
    {
        $this->RmsLimiter = $RmsLimiter;

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
