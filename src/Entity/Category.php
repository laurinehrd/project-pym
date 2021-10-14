<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"category:read"}},
 *      denormalizationContext={"groups"={"category:write"}}
 * )
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"category:read", "ingredients:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"category:read", "category:write", "ingredients:read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Ingredients::class, mappedBy="category", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $ingredients;

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
