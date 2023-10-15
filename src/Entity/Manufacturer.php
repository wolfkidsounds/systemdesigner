<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
#[Broadcast]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'manufacturers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'Manufacturer', targetEntity: Processor::class)]
    private Collection $processors;

    #[ORM\Column(type: 'boolean')]
    private ?bool $Validated = false;

    #[ORM\OneToMany(mappedBy: 'Manufacturer', targetEntity: Amplifier::class)]
    private Collection $amplifiers;

    #[ORM\OneToMany(mappedBy: 'Manufacturer', targetEntity: Speaker::class)]
    private Collection $speakers;

    public function __construct()
    {
        $this->processors = new ArrayCollection();
        $this->amplifiers = new ArrayCollection();
        $this->speakers = new ArrayCollection();
    }

    public function __toString() {
        return $this->Name;
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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, Processor>
     */
    public function getProcessors(): Collection
    {
        return $this->processors;
    }

    public function addProcessor(Processor $processor): static
    {
        if (!$this->processors->contains($processor)) {
            $this->processors->add($processor);
            $processor->setManufacturer($this);
        }

        return $this;
    }

    public function removeProcessor(Processor $processor): static
    {
        if ($this->processors->removeElement($processor)) {
            // set the owning side to null (unless already changed)
            if ($processor->getManufacturer() === $this) {
                $processor->setManufacturer(null);
            }
        }

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

    /**
     * @return Collection<int, Amplifier>
     */
    public function getAmplifiers(): Collection
    {
        return $this->amplifiers;
    }

    public function addAmplifier(Amplifier $amplifier): static
    {
        if (!$this->amplifiers->contains($amplifier)) {
            $this->amplifiers->add($amplifier);
            $amplifier->setManufacturer($this);
        }

        return $this;
    }

    public function removeAmplifier(Amplifier $amplifier): static
    {
        if ($this->amplifiers->removeElement($amplifier)) {
            // set the owning side to null (unless already changed)
            if ($amplifier->getManufacturer() === $this) {
                $amplifier->setManufacturer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Speaker>
     */
    public function getSpeakers(): Collection
    {
        return $this->speakers;
    }

    public function addSpeaker(Speaker $speaker): static
    {
        if (!$this->speakers->contains($speaker)) {
            $this->speakers->add($speaker);
            $speaker->setManufacturer($this);
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): static
    {
        if ($this->speakers->removeElement($speaker)) {
            // set the owning side to null (unless already changed)
            if ($speaker->getManufacturer() === $this) {
                $speaker->setManufacturer(null);
            }
        }

        return $this;
    }
}
