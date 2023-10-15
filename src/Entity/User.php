<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Manufacturer::class)]
    private Collection $manufacturers;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Processor::class)]
    private Collection $processors;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column]
    private array $settings = [];

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Amplifier::class)]
    private Collection $amplifiers;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Speaker::class)]
    private Collection $speakers;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Limiter::class)]
    private Collection $limiters;
    public function __construct()
    {
        $this->manufacturers = new ArrayCollection();
        $this->processors = new ArrayCollection();
        $this->amplifiers = new ArrayCollection();
        $this->speakers = new ArrayCollection();
        $this->limiters = new ArrayCollection();
    }

    public function __toString() {
        return $this->username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Manufacturer>
     */
    public function getManufacturers(): Collection
    {
        return $this->manufacturers;
    }

    public function addManufacturer(Manufacturer $manufacturer): static
    {
        if (!$this->manufacturers->contains($manufacturer)) {
            $this->manufacturers->add($manufacturer);
            $manufacturer->setUser($this);
        }

        return $this;
    }

    public function removeManufacturer(Manufacturer $manufacturer): static
    {
        if ($this->manufacturers->removeElement($manufacturer)) {
            // set the owning side to null (unless already changed)
            if ($manufacturer->getUser() === $this) {
                $manufacturer->setUser(null);
            }
        }

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
            $processor->setUser($this);
        }

        return $this;
    }

    public function removeProcessor(Processor $processor): static
    {
        if ($this->processors->removeElement($processor)) {
            // set the owning side to null (unless already changed)
            if ($processor->getUser() === $this) {
                $processor->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getSettings(): array
    {
        $settings = $this->settings;

        return array_unique($settings);
    }

    public function setSettings(array $settings): static
    {
        $this->settings = $settings;

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
            $amplifier->setUser($this);
        }

        return $this;
    }

    public function removeAmplifier(Amplifier $amplifier): static
    {
        if ($this->amplifiers->removeElement($amplifier)) {
            // set the owning side to null (unless already changed)
            if ($amplifier->getUser() === $this) {
                $amplifier->setUser(null);
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
            $speaker->setUser($this);
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): static
    {
        if ($this->speakers->removeElement($speaker)) {
            // set the owning side to null (unless already changed)
            if ($speaker->getUser() === $this) {
                $speaker->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Limiter>
     */
    public function getLimiters(): Collection
    {
        return $this->limiters;
    }

    public function addLimiter(Limiter $limiter): static
    {
        if (!$this->limiters->contains($limiter)) {
            $this->limiters->add($limiter);
            $limiter->setUser($this);
        }

        return $this;
    }

    public function removeLimiter(Limiter $limiter): static
    {
        if ($this->limiters->removeElement($limiter)) {
            // set the owning side to null (unless already changed)
            if ($limiter->getUser() === $this) {
                $limiter->setUser(null);
            }
        }

        return $this;
    }
}
