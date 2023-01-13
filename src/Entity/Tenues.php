<?php

namespace App\Entity;

use App\Repository\TenuesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TenuesRepository::class)
 */
class Tenues
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_tn;

    /**
     * @ORM\Column(type="string", length=24)
     */
    private $numero_tn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $abreviation_tn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $tn_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tn_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tenues")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="tenues")
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

    public function getNomTn(): ?string
    {
        return $this->nom_tn;
    }

    public function setNomTn(string $nom_tn): self
    {
        $this->nom_tn = $nom_tn;

        return $this;
    }

    public function getNumeroTn(): ?string
    {
        return $this->numero_tn;
    }

    public function setNumeroTn(string $numero_tn): self
    {
        $this->numero_tn = $numero_tn;

        return $this;
    }

    public function getAbreviationTn(): ?string
    {
        return $this->abreviation_tn;
    }

    public function setAbreviationTn(?string $abreviation_tn): self
    {
        $this->abreviation_tn = $abreviation_tn;

        return $this;
    }

    public function getTnCreated(): ?\DateTimeInterface
    {
        return $this->tn_created;
    }

    public function setTnCreated(\DateTimeInterface $tn_created): self
    {
        $this->tn_created = $tn_created;

        return $this;
    }

    public function getTnUpdated(): ?\DateTimeInterface
    {
        return $this->tn_updated;
    }

    public function setTnUpdated(?\DateTimeInterface $tn_updated): self
    {
        $this->tn_updated = $tn_updated;

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
            $designation->setTenues($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getTenues() === $this) {
                $designation->setTenues(null);
            }
        }

        return $this;
    }
}
