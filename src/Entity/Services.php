<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=124)
     */
    private $nom_sce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sce_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $sce_updated;

    /**
     * @ORM\ManyToOne(targetEntity=TypesServices::class, inversedBy="Services")
     */
    private $typesService;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Services")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $abreviation_sce;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="services")
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

    public function getNomSce(): ?string
    {
        return $this->nom_sce;
    }

    public function setNomSce(string $nom_sce): self
    {
        $this->nom_sce = $nom_sce;

        return $this;
    }

    public function getSceCreated(): ?\DateTimeInterface
    {
        return $this->sce_created;
    }

    public function setSceCreated(\DateTimeInterface $sce_created): self
    {
        $this->sce_created = $sce_created;

        return $this;
    }

    public function getSceUpdated(): ?\DateTimeInterface
    {
        return $this->sce_updated;
    }

    public function setSceUpdated(?\DateTimeInterface $sce_updated): self
    {
        $this->sce_updated = $sce_updated;

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

    public function getTypesService(): ?TypesServices
    {
        return $this->typesService;
    }

    public function setTypesService(?TypesServices $typesService): self
    {
        $this->typesService = $typesService;

        return $this;
    }

    public function getAbreviationSce(): ?string
    {
        return $this->abreviation_sce;
    }

    public function setAbreviationSce(?string $abreviation_sce): self
    {
        $this->abreviation_sce = $abreviation_sce;

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
            $designation->setServices($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getServices() === $this) {
                $designation->setServices(null);
            }
        }

        return $this;
    }
}
