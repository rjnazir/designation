<?php

namespace App\Entity;

use App\Repository\MotifsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotifsRepository::class)
 */
class Motifs
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
    private $libelle_mtf;

    /**
     * @ORM\Column(type="string", length=124, nullable=true)
     */
    private $abreviation_mtf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $mtf_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $mtf_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="motifs")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Absences::class, mappedBy="motifs")
     */
    private $absences;

    public function __construct()
    {
        $this->absences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleMtf(): ?string
    {
        return $this->libelle_mtf;
    }

    public function setLibelleMtf(string $libelle_mtf): self
    {
        $this->libelle_mtf = $libelle_mtf;

        return $this;
    }

    public function getAbreviationMtf(): ?string
    {
        return $this->abreviation_mtf;
    }

    public function setAbreviationMtf(?string $abreviation_mtf): self
    {
        $this->abreviation_mtf = $abreviation_mtf;

        return $this;
    }

    public function getMtfCreated(): ?\DateTimeInterface
    {
        return $this->mtf_created;
    }

    public function setMtfCreated(\DateTimeInterface $mtf_created): self
    {
        $this->mtf_created = $mtf_created;

        return $this;
    }

    public function getMtfUpdated(): ?\DateTimeInterface
    {
        return $this->mtf_updated;
    }

    public function setMtfUpdated(\DateTimeInterface $mtf_updated): self
    {
        $this->mtf_updated = $mtf_updated;

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
            $absence->setMotifs($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getMotifs() === $this) {
                $absence->setMotifs(null);
            }
        }

        return $this;
    }
}
