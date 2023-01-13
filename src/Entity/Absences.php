<?php

namespace App\Entity;

use App\Repository\AbsencesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AbsencesRepository::class)
 * @UniqueEntity(
 *  fields={"personnels", "motifs", "date_debut_abs", "date_fin_abs"},
 *  errorPath="personnels",
 *  message="L'absence du personnel avec ce motif dans cette période est déjà existante"
 * )
 */
class Absences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut_abs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin_abs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $abs_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $abs_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="absences")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Motifs::class, inversedBy="absences")
     */
    private $motifs;

    /**
     * @ORM\ManyToOne(targetEntity=Personnels::class, inversedBy="absences")
     */
    private $personnels;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutAbs(): ?\DateTimeInterface
    {
        return $this->date_debut_abs;
    }

    public function setDateDebutAbs(\DateTimeInterface $date_debut_abs): self
    {
        $this->date_debut_abs = $date_debut_abs;

        return $this;
    }

    public function getDateFinAbs(): ?\DateTimeInterface
    {
        return $this->date_fin_abs;
    }

    public function setDateFinAbs(\DateTimeInterface $date_fin_abs): self
    {
        $this->date_fin_abs = $date_fin_abs;

        return $this;
    }

    public function getAbsCreated(): ?\DateTimeInterface
    {
        return $this->abs_created;
    }

    public function setAbsCreated(\DateTimeInterface $abs_created): self
    {
        $this->abs_created = $abs_created;

        return $this;
    }

    public function getAbsUpdated(): ?\DateTimeInterface
    {
        return $this->abs_updated;
    }

    public function setAbsUpdated(?\DateTimeInterface $abs_updated): self
    {
        $this->abs_updated = $abs_updated;

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

    public function getMotifs(): ?Motifs
    {
        return $this->motifs;
    }

    public function setMotifs(?Motifs $motifs): self
    {
        $this->motifs = $motifs;

        return $this;
    }

    public function getPersonnels(): ?Personnels
    {
        return $this->personnels;
    }

    public function setPersonnels(?Personnels $personnels): self
    {
        $this->personnels = $personnels;

        return $this;
    }

}
