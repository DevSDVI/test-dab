<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RetraitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RetraitRepository::class)
 * @ORM\Table(name="retrait")
 */
class Retrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="ret_id", type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(name="ret_date", type="datetime")
     */
    private ?\DateTime $date = null;

    /**
     * @ORM\Column(name="ret_numcarte", type="string", length=50, nullable=true)
     */
    private ?string $numCarte = null;

    /**
     * @ORM\ManyToMany(targetEntity=Billet::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     name="ret_bil",
     *     joinColumns={@ORM\JoinColumn(name="id_ret", referencedColumnName="ret_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="id_bil", referencedColumnName="bil_id", unique=true)}
     * )
     */
    private Collection $billets;

    /**
     * @ORM\ManyToOne(targetEntity=Dab::class, inversedBy="retraits")
     * @ORM\JoinColumn(name="ret_dab", referencedColumnName="dab_id")
     */
    private ?Dab $dab = null;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Retrait
     */
    public function setDate(\DateTime $date): Retrait
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumCarte(): ?string
    {
        return $this->numCarte;
    }

    /**
     * @param string|null $numCarte
     *
     * @return Retrait
     */
    public function setNumCarte(?string $numCarte): Retrait
    {
        $this->numCarte = $numCarte;

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
     * @return Retrait
     */
    public function addBillet(Billet $billet): Retrait
    {
        if (!$this->billets->contains($billet)) {
            $this->billets[] = $billet;
        }

        return $this;
    }

    /**
     * @param Billet $billet
     *
     * @return Retrait
     */
    public function removeBillet(Billet $billet): Retrait
    {
        if ($this->billets->contains($billet)) {
            $this->billets->removeElement($billet);
        }

        return $this;
    }

    /**
     * @return Dab|null
     */
    public function getDab(): ?Dab
    {
        return $this->dab;
    }

    /**
     * @param Dab $dab
     *
     * @return Retrait
     */
    public function setDab(Dab $dab): Retrait
    {
        $this->dab = $dab;

        return $this;
    }
}
