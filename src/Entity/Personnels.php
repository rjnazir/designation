<?php

namespace App\Entity;

use App\Repository\PersonnelsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PersonnelsRepository::class)
 * @UniqueEntity(fields="matricule_pers", message="Le matricule entré est déjà existant")
 */
class Personnels
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=6, unique=true)
     */
    private $matricule_pers;

    /**
     * @ORM\Column(type="string", length=24)
     */
    private $grade_pers;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $nom_pers;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $prenoms_pers;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $fonctions_pers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_out_cr;

    /**
     * @ORM\Column(type="datetime")
     */
    private $pers_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $pers_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="personnels")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Absences::class, mappedBy="personnels")
     */
    private $absences;

    /**
     * @ORM\OneToMany(targetEntity=Designations::class, mappedBy="personnels")
     */
    private $designations;
    /**
     * @ORM\ManyToOne(targetEntity=Unites::class, inversedBy="personnels")
     */
    private $unites;
    public function __construct()
    {
        $this->absences = new ArrayCollection();
        $this->designations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculePers(): ?int
    {
        return $this->matricule_pers;
    }

    public function setMatriculePers(int $matricule_pers): self
    {
        $this->matricule_pers = $matricule_pers;

        return $this;
    }

    public function getGradePers(): ?string
    {
        return $this->grade_pers;
    }

    public function setGradePers(string $grade_pers): self
    {
        $this->grade_pers = $grade_pers;

        return $this;
    }

    public function getNomPers(): ?string
    {
        return $this->nom_pers;
    }

    public function setNomPers(string $nom_pers): self
    {
        $this->nom_pers = $nom_pers;

        return $this;
    }

    public function getPrenomsPers(): ?string
    {
        return $this->prenoms_pers;
    }

    public function setPrenomsPers(?string $prenoms_pers): self
    {
        $this->prenoms_pers = $prenoms_pers;

        return $this;
    }

    public function getFonctionsPers(): ?string
    {
        return $this->fonctions_pers;
    }

    public function setFonctionsPers(string $fonctions_pers): self
    {
        $this->fonctions_pers = $fonctions_pers;

        return $this;
    }

    public function isIsOutCr(): ?bool
    {
        return $this->is_out_cr;
    }

    public function setIsOutCr(?bool $is_out_cr): self
    {
        $this->is_out_cr = $is_out_cr;

        return $this;
    }

    public function getPersCreated(): ?\DateTimeInterface
    {
        return $this->pers_created;
    }

    public function setPersCreated(\DateTimeInterface $pers_created): self
    {
        $this->pers_created = $pers_created;

        return $this;
    }

    public function getPersUpdated(): ?\DateTimeInterface
    {
        return $this->pers_updated;
    }

    public function setPersUpdated(?\DateTimeInterface $pers_updated): self
    {
        $this->pers_updated = $pers_updated;

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
    public function getUnites(): ?Unites
    {
        return $this->unites;
    }

    public function setUnites(?Unites $unites): self
    {
        $this->unites = $unites;

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
            $absence->setPersonnels($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getPersonnels() === $this) {
                $absence->setPersonnels(null);
            }
        }

        return $this;
    }

    public function getInZoneDeListe(): ?string {
       // if($this.getMatriculePers()==1)
          //  return $this->getGradePers() . ' ' . $this->getNomPers() . ' ' . $this->getPrenomsPers() . ' (PO) ' ;
       // else    
            return $this->getGradePers() . ' ' . $this->getNomPers() . ' ' . $this->getPrenomsPers() . ' (Mle ' . $this->getMatriculePers() . ')' ;

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
            $designation->setPersonnels($this);
        }

        return $this;
    }

    public function removeDesignation(Designations $designation): self
    {
        if ($this->designations->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getPersonnels() === $this) {
                $designation->setPersonnels(null);
            }
        }

        return $this;
    }
}
