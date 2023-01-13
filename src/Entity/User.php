<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields="username", message="Le nom d'utilisateur entrée est déjà existant")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\OneToMany(targetEntity=Tenues::class, mappedBy="user")
     */
    private $tenues;

    /**
     * @ORM\OneToMany(targetEntity=Personnels::class, mappedBy="user")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Transports::class, mappedBy="user")
     */
    private $transports;

    /**
     * @ORM\OneToMany(targetEntity=TypeArmements::class, mappedBy="user")
     */
    private $typeArmements;

    /**
     * @ORM\OneToMany(targetEntity=Munitions::class, mappedBy="user")
     */
    private $munitions;

    /**
     * @ORM\OneToMany(targetEntity=Absences::class, mappedBy="user")
     */
    private $absences;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="user")
     */
    private $designations;

    public function __construct()
    {
        $this->tenues = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->transports = new ArrayCollection();
        $this->typeArmements = new ArrayCollection();
        $this->munitions = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->designations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, Tenues>
     */
    public function getTenues(): Collection
    {
        return $this->tenues;
    }

    public function addTenue(Tenues $tenue): self
    {
        if (!$this->tenues->contains($tenue)) {
            $this->tenues[] = $tenue;
            $tenue->setUser($this);
        }

        return $this;
    }

    public function removeTenue(Tenues $tenue): self
    {
        if ($this->tenues->removeElement($tenue)) {
            // set the owning side to null (unless already changed)
            if ($tenue->getUser() === $this) {
                $tenue->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Personnels>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Personnels $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setUser($this);
        }

        return $this;
    }

    public function removeUser(Personnels $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUser() === $this) {
                $user->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transports>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transports $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setUser($this);
        }

        return $this;
    }

    public function removeTransport(Transports $transport): self
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getUser() === $this) {
                $transport->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeArmements>
     */
    public function getTypeArmements(): Collection
    {
        return $this->typeArmements;
    }

    public function addTypeArmement(TypeArmements $typeArmement): self
    {
        if (!$this->typeArmements->contains($typeArmement)) {
            $this->typeArmements[] = $typeArmement;
            $typeArmement->setUser($this);
        }

        return $this;
    }

    public function removeTypeArmement(TypeArmements $typeArmement): self
    {
        if ($this->typeArmements->removeElement($typeArmement)) {
            // set the owning side to null (unless already changed)
            if ($typeArmement->getUser() === $this) {
                $typeArmement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Munitions>
     */
    public function getMunitions(): Collection
    {
        return $this->munitions;
    }

    public function addMunition(Munitions $munition): self
    {
        if (!$this->munitions->contains($munition)) {
            $this->munitions[] = $munition;
            $munition->setUser($this);
        }

        return $this;
    }

    public function removeMunition(Munitions $munition): self
    {
        if ($this->munitions->removeElement($munition)) {
            // set the owning side to null (unless already changed)
            if ($munition->getUser() === $this) {
                $munition->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Absences>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absences $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setUser($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getUser() === $this) {
                $absence->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Designations>
     */
    public function getDesignations(): Collection
    {
        return $this->designations;
    }

    public function addDesignation(Designations $designation): self
    {
        if (!$this->designations->contains($designation)) {
            $this->designations[] = $designation;
            $designation->setUser($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getUser() === $this) {
                $designation->setUser(null);
            }
        }

        return $this;
    }
}
