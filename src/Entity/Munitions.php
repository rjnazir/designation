<?php

namespace App\Entity;

use App\Repository\MunitionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MunitionsRepository::class)
 * @UniqueEntity(fields="nom_mun", message="La munition entrée est déjà existante")
 */
class Munitions
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
    private $nom_mun;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $lot_mun;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $calibre_mun;

    /**
     * @ORM\Column(type="datetime")
     */
    private $mun_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $mun_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="munitions")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="munitions")
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

    public function getNomMun(): ?string
    {
        return $this->nom_mun;
    }

    public function setNomMun(string $nom_mun): self
    {
        $this->nom_mun = $nom_mun;

        return $this;
    }

    public function getLotMun(): ?string
    {
        return $this->lot_mun;
    }

    public function setLotMun(?string $lot_mun): self
    {
        $this->lot_mun = $lot_mun;

        return $this;
    }

    public function getCalibreMun(): ?float
    {
        return $this->calibre_mun;
    }

    public function setCalibreMun(?float $calibre_mun): self
    {
        $this->calibre_mun = $calibre_mun;

        return $this;
    }

    public function getMunCreated(): ?\DateTimeInterface
    {
        return $this->mun_created;
    }

    public function setMunCreated(\DateTimeInterface $mun_created): self
    {
        $this->mun_created = $mun_created;

        return $this;
    }

    public function getMunUpdated(): ?\DateTimeInterface
    {
        return $this->mun_updated;
    }

    public function setMunUpdated(?\DateTimeInterface $mun_updated): self
    {
        $this->mun_updated = $mun_updated;

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
            $designation->setMunitions($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getMunitions() === $this) {
                $designation->setMunitions(null);
            }
        }

        return $this;
    }
}
