<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MealsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MealsRepository::class)
 * 
 * @ApiResource(
 *      normalizationContext={"groups"={"meals:read"}},
 *      denormalizationContext={"groups"={"meals:write"}}
 * )
 */
class Meals
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("meals:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"meals:read", "meals:write"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="meal")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups("meals:read")
     */
    private $ingredients;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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



}
