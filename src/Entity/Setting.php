<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
#[Broadcast]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'settings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(length: 255)]
    private ?string $SettingKey = null;

    #[ORM\Column]
    private ?bool $SettingValue = null;

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

    public function getSettingKey(): ?string
    {
        return $this->SettingKey;
    }

    public function setSettingKey(string $SettingKey): static
    {
        $this->SettingKey = $SettingKey;

        return $this;
    }

    public function isSettingValue(): ?bool
    {
        return $this->SettingValue;
    }

    public function setSettingValue(bool $SettingValue): static
    {
        $this->SettingValue = $SettingValue;

        return $this;
    }
}
