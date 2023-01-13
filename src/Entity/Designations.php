<?php

namespace App\Entity;

use App\Repository\DesignationsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DesignationsRepository::class)
 */
class Designations
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
    private $date_depart_design;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_retour_design;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $itineraire;

    /**
     * @ORM\ManyToOne(targetEntity=Personnels::class, inversedBy="designations")
     */
    private $personnels;

    /**
     * @ORM\ManyToOne(targetEntity=Transports::class, inversedBy="designations")
     */
    private $transports;

    /**
     * @ORM\ManyToOne(targetEntity=Munitions::class, inversedBy="designations")
     */
    private $munitions;

    /**
     * @ORM\ManyToOne(targetEntity=TypeArmements::class, inversedBy="designations")
     */
    private $type_armements;

    /**
     * @ORM\ManyToOne(targetEntity=Tenues::class, inversedBy="designations")
     */
    private $tenues;

    /**
     * @ORM\Column(type="datetime")
     */
    private $desgn_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $design_updated;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="designations")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="designations")
     */
    private $user;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $suite_a_donner;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $observations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ordre_speciaux;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepartDesign(): ?\DateTimeInterface
    {
        return $this->date_depart_design;
    }

    public function setDateDepartDesign(\DateTimeInterface $date_depart_design): self
    {
        $this->date_depart_design = $date_depart_design;

        return $this;
    }

    public function getDateRetourDesign(): ?\DateTimeInterface
    {
        return $this->date_retour_design;
    }

    public function setDateRetourDesign(\DateTimeInterface $date_retour_design): self
    {
        $this->date_retour_design = $date_retour_design;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getItineraire(): ?string
    {
        return $this->itineraire;
    }

    public function setItineraire(?string $itineraire): self
    {
        $this->itineraire = $itineraire;

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

    public function getTransports(): ?Transports
    {
        return $this->transports;
    }

    public function setTransports(?Transports $transports): self
    {
        $this->transports = $transports;

        return $this;
    }

    public function getMunitions(): ?Munitions
    {
        return $this->munitions;
    }

    public function setMunitions(?Munitions $munitions): self
    {
        $this->munitions = $munitions;

        return $this;
    }

    public function getTypeArmements(): ?TypeArmements
    {
        return $this->type_armements;
    }

    public function setTypeArmements(?TypeArmements $type_armements): self
    {
        $this->type_armements = $type_armements;

        return $this;
    }

    public function getTenues(): ?Tenues
    {
        return $this->tenues;
    }

    public function setTenues(?Tenues $tenues): self
    {
        $this->tenues = $tenues;

        return $this;
    }

    public function getDesgnCreated(): ?\DateTimeInterface
    {
        return $this->desgn_created;
    }

    public function setDesgnCreated(\DateTimeInterface $desgn_created): self
    {
        $this->desgn_created = $desgn_created;

        return $this;
    }

    public function getDesignUpdated(): ?\DateTimeInterface
    {
        return $this->design_updated;
    }

    public function setDesignUpdated(?\DateTimeInterface $design_updated): self
    {
        $this->design_updated = $design_updated;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

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

    public function getSuiteADonner()
    {
        return $this->suite_a_donner;
    }

    public function setSuiteADonner($suite_a_donner): self
    {
        $this->suite_a_donner = $suite_a_donner;

        return $this;
    }

    public function getObservations()
    {
        return $this->observations;
    }

    public function setObservations($observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getOrdreSpeciaux(): ?string
    {
        return $this->ordre_speciaux;
    }

    public function setOrdreSpeciaux(?string $ordre_speciaux): self
    {
        $this->ordre_speciaux = $ordre_speciaux;

        return $this;
    }
}
