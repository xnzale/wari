<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotsRepository")
 */
class Depots
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\partenaire", inversedBy="depots")
     */
    private $idPart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepos(): ?\DateTimeInterface
    {
        return $this->dateDepos;
    }

    public function setDateDepos(\DateTimeInterface $dateDepos): self
    {
        $this->dateDepos = $dateDepos;

        return $this;
    }

    public function getIdPart(): ?partenaire
    {
        return $this->idPart;
    }

    public function setIdPart(?partenaire $idPart): self
    {
        $this->idPart = $idPart;

        return $this;
    }
}
