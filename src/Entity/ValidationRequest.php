<?php

namespace App\Entity;

use App\Repository\ValidationRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Object = null;

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
        return $this->Status;
    }

    public function setStatus(?string $Status): static
    {
        if ($Status == 'validated') {

            if ($this->Manufacturer) {
                $this->Manufacturer->setValidated(true);
            }
    
            if ($this->Processor) {
                $this->Processor->setValidated(true);
            }
    
            if ($this->Amplifier) {
                $this->Amplifier->setValidated(true);
            }
    
            if ($this->Speaker) {
                $this->Speaker->setValidated(true);
            }
    
            if ($this->Chassis) {
                $this->Chassis->setValidated(true);
            }

        }

        if ($Status == 'rejected') {

            if ($this->Manufacturer) {
                $this->Manufacturer->setValidated(false);
            }
    
            if ($this->Processor) {
                $this->Processor->setValidated(false);
            }
    
            if ($this->Amplifier) {
                $this->Amplifier->setValidated(false);
            }
    
            if ($this->Speaker) {
                $this->Speaker->setValidated(false);
            }
    
            if ($this->Chassis) {
                $this->Chassis->setValidated(false);
            }
        }

        $this->Status = $Status;

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

    public function getType(): ?string
    {
        if ($this->Manufacturer) {
            return 'Manufacturer';
        }

        if ($this->Processor) {
            return 'Processor';
        }

        if ($this->Amplifier) {
            return 'Amplifier';
        }

        if ($this->Speaker) {
            return 'Speaker';
        }

        if ($this->Chassis) {
            return 'Chassis';
        }

        else {
            return null;
        }

    }

    public function setType(?string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getObject(): ?string
    {
        if ($this->Manufacturer) {
            return $this->Manufacturer->getName();
        }

        if ($this->Processor) {
            return $this->Processor->getManufacturer()->getName() . ' - ' . $this->Processor->getName();
        }

        if ($this->Amplifier) {
            return $this->Amplifier->getManufacturer()->getName() . ' - ' . $this->Amplifier->getName();
        }

        if ($this->Speaker) {
            return $this->Speaker->getManufacturer()->getName() . ' - ' . $this->Speaker->getName();
        }

        if ($this->Chassis) {
            return $this->Chassis->getManufacturer()->getName() . ' - ' . $this->Chassis->getName();
        }

        else {
            return null;
        }

    }

    public function setObject(?string $Object): static
    {
        $this->Object = $Object;
        return $this;
        
    }
}