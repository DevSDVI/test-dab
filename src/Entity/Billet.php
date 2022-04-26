<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BilletRepository::class)
 * @ORM\Table(name="billet")
 */
class Billet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="bil_id", type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(name="bil_montantunitaire", type="integer", nullable=false)
     */
    private ?int $montantUnitaire = null;

    /**
     * @ORM\Column(name="bil_quantite", type="integer", nullable=false)
     */
    private ?int $quantite = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getMontantUnitaire(): ?int
    {
        return $this->montantUnitaire;
    }

    /**
     * @param int $montantUnitaire
     *
     * @return Billet
     */
    public function setMontantUnitaire(int $montantUnitaire): Billet
    {
        $this->montantUnitaire = $montantUnitaire;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     *
     * @return Billet
     */
    public function setQuantite(int $quantite): Billet
    {
        $this->quantite = $quantite;

        return $this;
    }
}
