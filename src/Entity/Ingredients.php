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
     * @ORM\ManyToOne(targetEntity=category::class)
     * 
     * @Groups("ingredients:read")
     */
    private $id_category;

    /**
     * @ORM\OneToMany(targetEntity=Meals::class, mappedBy="ingredients")
     * 
     * @Groups("ingredients:read")
     */
    private $meal;



    public function __construct()
    {
        $this->meal = new ArrayCollection();
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

    public function getIdCategory(): ?category
    {
        return $this->id_category;
    }

    public function setIdCategory(?category $id_category): self
    {
        $this->id_category = $id_category;

        return $this;
    }

    /**
     * @return Collection|Meals[]
     */
    public function getMeal(): Collection
    {
        return $this->meal;
    }

    public function addMeal(Meals $meal): self
    {
        if (!$this->meal->contains($meal)) {
            $this->meal[] = $meal;
            $meal->setIngredients($this);
        }

        return $this;
    }

    public function removeMeal(Meals $meal): self
    {
        if ($this->meal->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getIngredients() === $this) {
                $meal->setIngredients(null);
            }
        }

        return $this;
    }


}
