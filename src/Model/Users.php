<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @Assert\NotNull (message="Veuillez renseigner un username.")
     */
    public $username;

    /**
     * @Assert\NotNull (message="Veuillez renseigner un mot de passe.")
     */
    public $password;

    /**
     * @Assert\Email (message="Veuillez renseigner un email valide.")
     */
    public $email;

    
     public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles): self
    {
        $this->roles = $roles;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    
    public function getSalt(): ?string
    {
        return null;
    }
    
    public function eraseCredentials(): void
    {
        
    }
    
    public function serialize(): string
    {
        return serialize([$this->id, $this->username, $this->password]);
    }
    
    public function unserialize($serialized): void
    {
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }
}
