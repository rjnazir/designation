<?php

namespace App\Entity;

use App\Repository\UnitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitesRepository::class)
 */
class Unites
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
    private $nom_ute;

    /**
     * @ORM\Column(type="string", length=124)
     */
    private $localite_ute;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $abreviation_ute;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     */
    private $contact_ute;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ute_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ute_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Unites")
     */
    private $user;

   /**
     * @ORM\OneToMany(targetEntity="App\Entity\Unites", mappedBy="unite_superieur")
     */
    private $unites; 

    public function __construct()
    {
        $this->Utes_sup = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUte(): ?string
    {
        return $this->nom_ute;
    }

    public function setNomUte(string $nom_ute): self
    {
        $this->nom_ute = $nom_ute;

        return $this;
    }

    public function getLocaliteUte(): ?string
    {
        return $this->localite_ute;
    }

    public function setLocaliteUte(string $localite_ute): self
    {
        $this->localite_ute = $localite_ute;

        return $this;
    }

    public function getAbreviationUte(): ?string
    {
        return $this->abreviation_ute;
    }

    public function setAbreviationUte(string $abreviation_ute): self
    {
        $this->abreviation_ute = $abreviation_ute;

        return $this;
    }

    public function getContactUte(): ?string
    {
        return $this->contact_ute;
    }

    public function setContactUte(?string $contact_ute): self
    {
        $this->contact_ute = $contact_ute;

        return $this;
    }

    public function getUteCreated(): ?\DateTimeInterface
    {
        return $this->ute_created;
    }

    public function setUteCreated(\DateTimeInterface $ute_created): self
    {
        $this->ute_created = $ute_created;

        return $this;
    }

    public function getUteUpdated(): ?\DateTimeInterface
    {
        return $this->ute_updated;
    }

    public function setUteUpdated(?\DateTimeInterface $ute_updated): self
    {
        $this->ute_updated = $ute_updated;

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

    public function getUniteSuperieur(): ?self
    {
        return $this->unite_superieur;
    }

    public function setUniteSuperieur(?self $unite_superieur): self
    {
        $this->unite_superieur = $unite_superieur;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUnites(): Collection
    {
        return $this->unites;
    }

    public function addUnite(self $unite): self
    {
        if (!$this->unites->contains($unite)) {
            $this->unites[] = $unite;
            $unite->setUniteSuperieur($this);
        }

        return $this;
    }

    public function removeUnite(self $unite): self
    {
        if ($this->unites->contains($unite)) {
            $this->unites->removeElement($unite);
            // set the owning side to null (unless already changed)
            if ($unite->getUniteSuperieur() === $this) {
                $unite->setUniteSuperieur(null);
            }
        }

        return $this;
    }

    public function addUtesSup(self $utesSup): self
    {
        if (!$this->Utes_sup->contains($utesSup)) {
            $this->Utes_sup[] = $utesSup;
            $utesSup->setUtesSup($this);
        }

        return $this;
    }

    public function removeUtesSup(self $utesSup): self
    {
        if ($this->Utes_sup->removeElement($utesSup)) {
            // set the owning side to null (unless already changed)
            if ($utesSup->getUtesSup() === $this) {
                $utesSup->setUtesSup(null);
            }
        }

        return $this;
    }
    public function getInZoneDeListe(): ?string {
        return $this->getAbreviationUte() . ' ' . $this->getLocaliteUte() ;
    }
}
