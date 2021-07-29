<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IngredientsRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"ingredients:read"}},
 *      denormalizationContext={"groups"={"ingredients:write"}}
 * )
 */
class Ingredients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("ingredients:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"ingredients:read", "ingredients:write"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * 
     * @Groups({"ingredients:read", "ingredients:write"})
     */
    private $category;


    /**
     * @ORM\OneToMany(targetEntity=Intermediaire::class, mappedBy="ingredients", orphanRemoval=true)
     */
    private $intermediaires;



    public function __construct()
    {
        $this->meal = new ArrayCollection();
        $this->intermediaires = new ArrayCollection();
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

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }


    /**
     * @return Collection|Intermediaire[]
     */
    public function getIntermediaires(): Collection
    {
        return $this->intermediaires;
    }

    public function addIntermediaire(Intermediaire $intermediaire): self
    {
        if (!$this->intermediaires->contains($intermediaire)) {
            $this->intermediaires[] = $intermediaire;
            $intermediaire->setIngredients($this);
        }

        return $this;
    }

    public function removeIntermediaire(Intermediaire $intermediaire): self
    {
        if ($this->intermediaires->removeElement($intermediaire)) {
            // set the owning side to null (unless already changed)
            if ($intermediaire->getIngredients() === $this) {
                $intermediaire->setIngredients(null);
            }
        }

        return $this;
    }


}
