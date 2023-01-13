<?php

namespace App\Entity;

use App\Repository\AutresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutresRepository::class)
 */
class Autres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="autres")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity=Personnels::class, inversedBy="autres")
     */
    private $personnels;
    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="autres")
     */
    private $services;

    /**
     * @ORM\Column(type="datetime")
     */
    private $autre_created;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getPersonnels(): ?Personnels
    {
        return $this->personnels;
    }

    public function setPersonnels(?Personnels $personnels): self
    {
        $this->personnels = $personnels;

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

    public function getAutreCreated(): ?\DateTimeInterface
    {
        return $this->autre_created;
    }

    public function setAutreCreated(\DateTimeInterface $autre_created): self
    {
        $this->autre_created = $autre_created;

        return $this;
    }
}
