<?php

namespace App\Entity;

use App\Repository\ChassisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ChassisRepository::class)]
#[Broadcast]
class Chassis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'chassis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'chassis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $Manufacturer = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $Validated = false;

    #[ORM\ManyToMany(targetEntity: Speaker::class, mappedBy: 'Chassis')]
    private Collection $speakers;

    #[ORM\Column]
    private ?float $Fs = null;

    #[ORM\Column]
    private ?float $Cms = null;

    #[ORM\Column]
    private ?float $Mms = null;

    #[ORM\Column]
    private ?float $Qms = null;

    #[ORM\Column]
    private ?float $Qes = null;

    #[ORM\Column]
    private ?float $Qts = null;

    #[ORM\Column]
    private ?float $Vas = null;

    #[ORM\Column]
    private ?float $Re = null;

    #[ORM\Column]
    private ?float $Bl = null;

    #[ORM\Column]
    private ?float $Le = null;

    #[ORM\Column]
    private ?float $Xmax = null;

    #[ORM\Column]
    private ?float $Sd = null;

    #[ORM\Column(nullable: true)]
    private ?float $Rms = null;

    #[ORM\Column]
    private ?int $NominalImpedance = null;

    #[ORM\Column]
    private ?int $PowerRMS = null;

    #[ORM\Column]
    private ?float $Sensitivity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $WindingMaterial = null;

    #[ORM\OneToMany(mappedBy: 'Chassis', targetEntity: ValidationRequest::class)]
    private Collection $validationRequests;

    #[ORM\Column(nullable: true)]
    private ?float $Mmd = null;

    #[ORM\Column]
    private ?float $Vd = null;

    #[ORM\Column]
    private ?float $VoiceCoilDiameter = null;

    public function __construct()
    {
        $this->speakers = new ArrayCollection();
        $this->validationRequests = new ArrayCollection();
    }

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

    public function getManufacturer(): ?Manufacturer
    {
        return $this->Manufacturer;
    }

    public function setManufacturer(?Manufacturer $Manufacturer): static
    {
        $this->Manufacturer = $Manufacturer;

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
            $speaker->addChassis($this);
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): static
    {
        if ($this->speakers->removeElement($speaker)) {
            $speaker->removeChassis($this);
        }

        return $this;
    }

    public function getFs(): ?float
    {
        return $this->Fs;
    }

    public function setFs(float $Fs): static
    {
        $this->Fs = $Fs;

        return $this;
    }

    public function getCms(): ?float
    {
        return $this->Cms;
    }

    public function setCms(float $Cms): static
    {
        $this->Cms = $Cms;

        return $this;
    }

    public function getMms(): ?float
    {
        return $this->Mms;
    }

    public function setMms(float $Mms): static
    {
        $this->Mms = $Mms;

        return $this;
    }

    public function getQms(): ?float
    {
        return $this->Qms;
    }

    public function setQms(float $Qms): static
    {
        $this->Qms = $Qms;

        return $this;
    }

    public function getQes(): ?float
    {
        return $this->Qes;
    }

    public function setQes(float $Qes): static
    {
        $this->Qes = $Qes;

        return $this;
    }

    public function getQts(): ?float
    {
        return $this->Qts;
    }

    public function setQts(float $Qts): static
    {
        $this->Qts = $Qts;

        return $this;
    }

    public function getVas(): ?float
    {
        return $this->Vas;
    }

    public function setVas(float $Vas): static
    {
        $this->Vas = $Vas;

        return $this;
    }

    public function getRe(): ?float
    {
        return $this->Re;
    }

    public function setRe(float $Re): static
    {
        $this->Re = $Re;

        return $this;
    }

    public function getBl(): ?float
    {
        return $this->Bl;
    }

    public function setBl(float $Bl): static
    {
        $this->Bl = $Bl;

        return $this;
    }

    public function getLe(): ?float
    {
        return $this->Le;
    }

    public function setLe(float $Le): static
    {
        $this->Le = $Le;

        return $this;
    }

    public function getXmax(): ?float
    {
        return $this->Xmax;
    }

    public function setXmax(float $Xmax): static
    {
        $this->Xmax = $Xmax;

        return $this;
    }

    public function getSd(): ?float
    {
        return $this->Sd;
    }

    public function setSd(float $Sd): static
    {
        $this->Sd = $Sd;

        return $this;
    }

    public function getRms(): ?float
    {
        return $this->Rms;
    }

    public function setRms(?float $Rms): static
    {
        $this->Rms = $Rms;

        return $this;
    }

    public function getNominalImpedance(): ?int
    {
        return $this->NominalImpedance;
    }

    public function setNominalImpedance(int $NominalImpedance): static
    {
        $this->NominalImpedance = $NominalImpedance;

        return $this;
    }

    public function getPowerRMS(): ?int
    {
        return $this->PowerRMS;
    }

    public function setPowerRMS(int $PowerRMS): static
    {
        $this->PowerRMS = $PowerRMS;

        return $this;
    }

    public function getSensitivity(): ?float
    {
        return $this->Sensitivity;
    }

    public function setSensitivity(float $Sensitivity): static
    {
        $this->Sensitivity = $Sensitivity;

        return $this;
    }

    public function getWindingMaterial(): ?string
    {
        return $this->WindingMaterial;
    }

    public function setWindingMaterial(?string $WindingMaterial): static
    {
        $this->WindingMaterial = $WindingMaterial;

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
            $validationRequest->setChassis($this);
        }

        return $this;
    }

    public function removeValidationRequest(ValidationRequest $validationRequest): static
    {
        if ($this->validationRequests->removeElement($validationRequest)) {
            // set the owning side to null (unless already changed)
            if ($validationRequest->getChassis() === $this) {
                $validationRequest->setChassis(null);
            }
        }

        return $this;
    }

    public function getMmd(): ?float
    {
        return $this->Mmd;
    }

    public function setMmd(?float $Mmd): static
    {
        $this->Mmd = $Mmd;

        return $this;
    }

    public function getVd(): ?float
    {
        return $this->Vd;
    }

    public function setVd(float $Vd): static
    {
        $this->Vd = $Vd;

        return $this;
    }

    public function getVoiceCoilDiameter(): ?float
    {
        return $this->VoiceCoilDiameter;
    }

    public function setVoiceCoilDiameter(float $VoiceCoilDiameter): static
    {
        $this->VoiceCoilDiameter = $VoiceCoilDiameter;

        return $this;
    }
}
