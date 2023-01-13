<?php

namespace App\Entity;

use App\Repository\TypesServicesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TypesServicesRepository::class)
 * @UniqueEntity(fields="nom_type_sce", message="Le type de service entré est déjà existant")
 */
class TypesServices
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
    private $nom_type_sce;

    /**
     * @ORM\Column(type="string", length=124, nullable=true)
     */
    private $abreviation_type_sce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $typesce_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $typesce_updated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="TypesServices")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeSce(): ?string
    {
        return $this->nom_type_sce;
    }

    public function setNomTypeSce(string $nom_type_sce): self
    {
        $this->nom_type_sce = $nom_type_sce;

        return $this;
    }

    public function getAbreviationTypeSce(): ?string
    {
        return $this->abreviation_type_sce;
    }

    public function setAbreviationTypeSce(?string $abreviation_type_sce): self
    {
        $this->abreviation_type_sce = $abreviation_type_sce;

        return $this;
    }

    public function getTypesceCreated(): ?\DateTimeInterface
    {
        return $this->typesce_created;
    }

    public function setTypesceCreated(\DateTimeInterface $typesce_created): self
    {
        $this->typesce_created = $typesce_created;

        return $this;
    }

    public function getTypesceUpdated(): ?\DateTimeInterface
    {
        return $this->typesce_updated;
    }

    public function setTypesceUpdated(?\DateTimeInterface $typesce_updated): self
    {
        $this->typesce_updated = $typesce_updated;

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
}
