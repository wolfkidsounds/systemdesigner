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
    private ?float $ResonanceFrequency = null;

    #[ORM\Column]
    private ?float $Compliance = null;

    #[ORM\Column]
    private ?float $MovingMass = null;

    #[ORM\Column]
    private ?float $MechanicalGrade = null;

    #[ORM\Column]
    private ?float $ElectricalGrade = null;

    #[ORM\Column]
    private ?float $TotalGrade = null;

    #[ORM\Column]
    private ?float $EquivalentVolume = null;

    #[ORM\Column]
    private ?float $ResistanceDC = null;

    #[ORM\Column]
    private ?float $ForceFactor = null;

    #[ORM\Column]
    private ?float $VoiceCoilInductance = null;

    #[ORM\Column]
    private ?float $LinearDisplacement = null;

    #[ORM\Column]
    private ?float $EffectivePistonArea = null;

    #[ORM\Column(nullable: true)]
    private ?float $NetWeight = null;

    #[ORM\Column]
    private ?int $NominalImpedance = null;

    #[ORM\Column]
    private ?int $PowerRMS = null;

    #[ORM\Column]
    private ?float $Sensitivity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $WindingMaterial = null;

    public function __construct()
    {
        $this->speakers = new ArrayCollection();
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

    public function isValid(): ?bool
    {
        return $this->Validated;
    }

    public function setValid(bool $Validated): static
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

    public function getResonanceFrequency(): ?float
    {
        return $this->ResonanceFrequency;
    }

    public function setResonanceFrequency(float $ResonanceFrequency): static
    {
        $this->ResonanceFrequency = $ResonanceFrequency;

        return $this;
    }

    public function getCompliance(): ?float
    {
        return $this->Compliance;
    }

    public function setCompliance(float $Compliance): static
    {
        $this->Compliance = $Compliance;

        return $this;
    }

    public function getMovingMass(): ?float
    {
        return $this->MovingMass;
    }

    public function setMovingMass(float $MovingMass): static
    {
        $this->MovingMass = $MovingMass;

        return $this;
    }

    public function getMechanicalGrade(): ?float
    {
        return $this->MechanicalGrade;
    }

    public function setMechanicalGrade(float $MechanicalGrade): static
    {
        $this->MechanicalGrade = $MechanicalGrade;

        return $this;
    }

    public function getElectricalGrade(): ?float
    {
        return $this->ElectricalGrade;
    }

    public function setElectricalGrade(float $ElectricalGrade): static
    {
        $this->ElectricalGrade = $ElectricalGrade;

        return $this;
    }

    public function getTotalGrade(): ?float
    {
        return $this->TotalGrade;
    }

    public function setTotalGrade(float $TotalGrade): static
    {
        $this->TotalGrade = $TotalGrade;

        return $this;
    }

    public function getEquivalentVolume(): ?float
    {
        return $this->EquivalentVolume;
    }

    public function setEquivalentVolume(float $EquivalentVolume): static
    {
        $this->EquivalentVolume = $EquivalentVolume;

        return $this;
    }

    public function getResistanceDC(): ?float
    {
        return $this->ResistanceDC;
    }

    public function setResistanceDC(float $ResistanceDC): static
    {
        $this->ResistanceDC = $ResistanceDC;

        return $this;
    }

    public function getForceFactor(): ?float
    {
        return $this->ForceFactor;
    }

    public function setForceFactor(float $ForceFactor): static
    {
        $this->ForceFactor = $ForceFactor;

        return $this;
    }

    public function getVoiceCoilInductance(): ?float
    {
        return $this->VoiceCoilInductance;
    }

    public function setVoiceCoilInductance(float $VoiceCoilInductance): static
    {
        $this->VoiceCoilInductance = $VoiceCoilInductance;

        return $this;
    }

    public function getLinearDisplacement(): ?float
    {
        return $this->LinearDisplacement;
    }

    public function setLinearDisplacement(float $LinearDisplacement): static
    {
        $this->LinearDisplacement = $LinearDisplacement;

        return $this;
    }

    public function getEffectivePistonArea(): ?float
    {
        return $this->EffectivePistonArea;
    }

    public function setEffectivePistonArea(float $EffectivePistonArea): static
    {
        $this->EffectivePistonArea = $EffectivePistonArea;

        return $this;
    }

    public function getNetWeight(): ?float
    {
        return $this->NetWeight;
    }

    public function setNetWeight(?float $NetWeight): static
    {
        $this->NetWeight = $NetWeight;

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
}
