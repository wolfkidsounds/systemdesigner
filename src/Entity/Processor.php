<?php

namespace App\Entity;

use App\Repository\ProcessorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: 'boolean')]
    private ?bool $Validated = false;

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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Manual = null;

    #[ORM\OneToMany(mappedBy: 'Processor', targetEntity: ValidationRequest::class)]
    private Collection $validationRequests;

    public function __construct()
    {
        $this->validationRequests = new ArrayCollection();
    }

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

    public function getManual(): ?string
    {
        return $this->Manual;
    }

    public function setManual(?string $Manual): static
    {
        $this->Manual = $Manual;

        return $this;
    }

    /**
     * @return Collection<int, ValidationRequest>
     */
    public function getValidationRequests(): Collection
    {
        return $this->validationRequests;
    }

    public function addValidationRequest(ValidationRequest $validationRequest): static
    {
        if (!$this->validationRequests->contains($validationRequest)) {
            $this->validationRequests->add($validationRequest);
            $validationRequest->setProcessor($this);
        }

        return $this;
    }

    public function removeValidationRequest(ValidationRequest $validationRequest): static
    {
        if ($this->validationRequests->removeElement($validationRequest)) {
            // set the owning side to null (unless already changed)
            if ($validationRequest->getProcessor() === $this) {
                $validationRequest->setProcessor(null);
            }
        }

        return $this;
    }
}
