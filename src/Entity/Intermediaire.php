<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IntermediaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=IntermediaireRepository::class)
 */
class Intermediaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Meals::class, inversedBy="intermediaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meal;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="intermediaires", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredients;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Unity::class, inversedBy="intermediaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeal(): ?Meals
    {
        return $this->meal;
    }

    public function setMeal(?Meals $meal): self
    {
        $this->meal = $meal;

        return $this;
    }

    public function getIngredients(): ?Ingredients
    {
        return $this->ingredients;
    }

    public function setIngredients(?Ingredients $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnity(): ?Unity
    {
        return $this->unity;
    }

    public function setUnity(?Unity $unity): self
    {
        $this->unity = $unity;

        return $this;
    }
}
