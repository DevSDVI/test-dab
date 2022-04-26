<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DabRepository::class)
 * @ORM\Table(name="dab")
 */
class Dab
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="dab_id", type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(name="dab_name", type="string", length=20)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(name="dab_adresse", type="text", nullable=true)
     */
    private ?string $adresse = null;

    /**
     * @ORM\Column(name="dab_rechargement", type="datetime", nullable=true)
     */
    private ?\DateTime $rechargement = null;

    /**
     * @ORM\ManyToMany(targetEntity=Billet::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     name="dab_bil",
     *     joinColumns={@ORM\JoinColumn(name="id_dab", referencedColumnName="dab_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="id_bil", referencedColumnName="bil_id", unique=true)}
     * )
     */
    private Collection $billets;

    /**
     * @ORM\OneToMany(targetEntity=Retrait::class, mappedBy="dab", cascade={"persist", "remove"})
     */
    private Collection $retraits;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
        $this->retraits = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Dab
     */
    public function setName(string $name): Dab
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     *
     * @return Dab
     */
    public function setAdresse(?string $adresse): Dab
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getRechargement(): ?\DateTime
    {
        return $this->rechargement;
    }

    /**
     * @param \DateTime|null $rechargement
     *
     * @return Dab
     */
    public function setRechargement(?\DateTime $rechargement): Dab
    {
        $this->rechargement = $rechargement;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    /**
     * @param Billet $billet
     *
     * @return Dab
     */
    public function addBillet(Billet $billet): Dab
    {
        if (!$this->billets->contains($billet)) {
            $this->billets[] = $billet;
        }

        return $this;
    }

    /**
     * @param Billet $billet
     *
     * @return Dab
     */
    public function removeBillet(Billet $billet): Dab
    {
        if ($this->billets->contains($billet)) {
            $this->billets->removeElement($billet);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRetraits(): Collection
    {
        return $this->retraits;
    }

    /**
     * @param Retrait $retrait
     *
     * @return Dab
     */
    public function addRetrait(Retrait $retrait): Dab
    {
        if (!$this->retraits->contains($retrait)) {
            $this->retraits[] = $retrait;
            $retrait->setDab($this);
        }

        return $this;
    }

    /**
     * @param Retrait $retrait
     *
     * @return Dab
     */
    public function removeRetrait(Retrait $retrait): Dab
    {
        if ($this->retraits->contains($retrait)) {
            $this->retraits->removeElement($retrait);
        }

        return $this;
    }
}
