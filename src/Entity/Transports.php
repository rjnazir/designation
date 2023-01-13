<?php

namespace App\Entity;

use App\Repository\TransportsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TransportsRepository::class)
 * @UniqueEntity(fields="nom_transp", message="Le type de transport entré est déjà existant")
 */
class Transports
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
    private $nom_transp;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $abreviation_transp;

    /**
     * @ORM\Column(type="datetime")
     */
    private $transp_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $transp_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="transports")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="transports")
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

    public function getNomTransp(): ?string
    {
        return $this->nom_transp;
    }

    public function setNomTransp(string $nom_transp): self
    {
        $this->nom_transp = $nom_transp;

        return $this;
    }

    public function getAbreviationTransp(): ?string
    {
        return $this->abreviation_transp;
    }

    public function setAbreviationTransp(?string $abreviation_transp): self
    {
        $this->abreviation_transp = $abreviation_transp;

        return $this;
    }

    public function getTranspCreated(): ?\DateTimeInterface
    {
        return $this->transp_created;
    }

    public function setTranspCreated(\DateTimeInterface $transp_created): self
    {
        $this->transp_created = $transp_created;

        return $this;
    }

    public function getTranspUpdated(): ?\DateTimeInterface
    {
        return $this->transp_updated;
    }

    public function setTranspUpdated(?\DateTimeInterface $transp_updated): self
    {
        $this->transp_updated = $transp_updated;

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
            $designation->setTransports($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getTransports() === $this) {
                $designation->setTransports(null);
            }
        }

        return $this;
    }
}
