<?php

namespace App\Entity;

use App\Repository\TypeArmementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TypeArmementsRepository::class)
 * @UniqueEntity(fields="nom_arm", message="Le type d'armement entré est déjà existant")
 */
class TypeArmements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=124, unique=true)
     */
    private $nom_arm;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $abreviation_arm;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arm_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $arm_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="typeArmements")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="type_armements")
     */
    private $designations;

    public function __construct()
    {
        $this->designations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArm(): ?string
    {
        return $this->nom_arm;
    }

    public function setNomArm(string $nom_arm): self
    {
        $this->nom_arm = $nom_arm;

        return $this;
    }

    public function getAbreviationArm(): ?string
    {
        return $this->abreviation_arm;
    }

    public function setAbreviationArm(?string $abreviation_arm): self
    {
        $this->abreviation_arm = $abreviation_arm;

        return $this;
    }

    public function getArmCreated(): ?\DateTimeInterface
    {
        return $this->arm_created;
    }

    public function setArmCreated(\DateTimeInterface $arm_created): self
    {
        $this->arm_created = $arm_created;

        return $this;
    }

    public function getArmUpdated(): ?\DateTimeInterface
    {
        return $this->arm_updated;
    }

    public function setArmUpdated(?\DateTimeInterface $arm_updated): self
    {
        $this->arm_updated = $arm_updated;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $designation->setTypeArmements($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getTypeArmements() === $this) {
                $designation->setTypeArmements(null);
            }
        }

        return $this;
    }
}
