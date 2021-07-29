<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 * @ApiResource(
 *      normalizationContext={"groups"={"user:read"}},
 *      denormalizationContext={"groups"={"user:write"}}
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * 
     * @Groups({"user:read", "user:write"})
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     */
    private $password;

     /**
     * @Groups("user:write")
     * @SerializedName("password")
     */
    private $plainPassword;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }


    public function getUserIdentifier()
    {
        
    }

    public function getRoles()
    {
        
    }

    public function getSalt()
    {
        
    }

    public function getUsername()
    {
        
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
}
