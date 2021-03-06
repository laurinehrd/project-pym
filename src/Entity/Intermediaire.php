<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IntermediaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"intermediaires:read"}},
 *      denormalizationContext={"groups"={"intermediaires:write"}}
 * )
 * @ORM\Entity(repositoryClass=IntermediaireRepository::class)
 * 
 * @ApiFilter(SearchFilter::class, properties={"meal.id": "exact"})

 */
class Intermediaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"intermediaires:read", "intermediaires:write"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Meals::class, inversedBy="intermediaires")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"intermediaires:read", "intermediaires:write"})
     */
    private $meal;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="intermediaires")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"intermediaires:read", "intermediaires:write", "meals:write", "meals:readfull"})
     */
    private $ingredients;

    /**
     * @ORM\Column(type="float")
     * 
     * @Groups({"intermediaires:read", "intermediaires:write", "meals:write", "meals:readfull"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Unity::class, inversedBy="intermediaires")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"intermediaires:read", "intermediaires:write", "meals:write", "meals:readfull"})
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
