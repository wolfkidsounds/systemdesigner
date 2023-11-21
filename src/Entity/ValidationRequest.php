<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ValidationRequestRepository;

#[ORM\Entity(repositoryClass: ValidationRequestRepository::class)]
class ValidationRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'validationRequests')]
    private ?Manufacturer $Manufacturer = null;

    #[ORM\ManyToOne(inversedBy: 'validationRequests')]
    private ?Processor $Processor = null;

    #[ORM\ManyToOne(inversedBy: 'validationRequests')]
    private ?Amplifier $Amplifier = null;

    #[ORM\ManyToOne(inversedBy: 'validationRequests')]
    private ?Speaker $Speaker = null;

    #[ORM\ManyToOne(inversedBy: 'validationRequests')]
    private ?Chassis $Chassis = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Status = null;

    #[ORM\ManyToOne(inversedBy: 'validationRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChassis(): ?Chassis
    {
        return $this->Chassis;
    }

    public function setChassis(?Chassis $Chassis): static
    {
        $this->Chassis = $Chassis;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(?string $Message): static
    {
        $this->Message = $Message;

        return $this;
    }

    public function getStatus(): ?string
    {
        dump($this->Status);
        return $this->Status;
    }

    public function setStatus(?string $Status): static
    {
        $this->Status = $Status;

        dump($Status);

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

    public function getObject(): ?string
    {
        if ($this->Manufacturer) {
            $type = $this->Manufacturer;
        }

        if ($this->Processor) {
            $type = $this->Processor;
        }

        if ($this->Amplifier) {
            $type = $this->Amplifier;
        }

        if ($this->Speaker) {
            $type = $this->Speaker;
        }

        if ($this->Chassis) {
            $type = $this->Chassis;
        }

        return $type;
    }

    public function getName(): ?string
    {
        if ($this->Manufacturer) {
            $object = $this->Manufacturer->getName();
        }

        if ($this->Processor) {
            $object = $this->Processor->getManufacturer()->getName() . ' - ' .$this->Processor->getName();
        }

        if ($this->Amplifier) {
            $object = $this->Amplifier->getManufacturer()->getName() . ' - ' .$this->Amplifier->getName();
        }

        if ($this->Speaker) {
            $object = $this->Speaker->getManufacturer()->getName() . ' - ' .$this->Speaker->getName();
        }

        if ($this->Chassis) {
            $object = $this->Chassis->getManufacturer()->getName() . ' - ' .$this->Chassis->getName();
        }

        return $object;
    }
}