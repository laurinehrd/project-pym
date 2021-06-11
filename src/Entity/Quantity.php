<?php

namespace App\Entity;

use App\Repository\QuantityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuantityRepository::class)
 */
class Quantity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte_nb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qte_unity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteNb(): ?int
    {
        return $this->qte_nb;
    }

    public function setQteNb(int $qte_nb): self
    {
        $this->qte_nb = $qte_nb;

        return $this;
    }

    public function getQteUnity(): ?string
    {
        return $this->qte_unity;
    }

    public function setQteUnity(string $qte_unity): self
    {
        $this->qte_unity = $qte_unity;

        return $this;
    }
}
