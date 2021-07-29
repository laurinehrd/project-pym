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
     * @ORM\OneToMany(targetEntity=Intermediaire::class, mappedBy="meal", orphanRemoval=true)
     */
    private $intermediaires;


    public function __construct()
    {
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
            $intermediaire->setMeal($this);
        }

        return $this;
    }

    public function removeIntermediaire(Intermediaire $intermediaire): self
    {
        if ($this->intermediaires->removeElement($intermediaire)) {
            // set the owning side to null (unless already changed)
            if ($intermediaire->getMeal() === $this) {
                $intermediaire->setMeal(null);
            }
        }

        return $this;
    }



}
