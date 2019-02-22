<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanetsRepository")
 */
class Planets
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", mappedBy="whatPlanets")
     */
    private $ressourcesOnPlanet;

    public function __construct()
    {
        $this->ressourcesOnPlanet = new ArrayCollection();
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
     * @return Collection|Ressources[]
     */
    public function getRessourcesOnPlanet(): Collection
    {
        return $this->ressourcesOnPlanet;
    }

    public function addRessourcesOnPlanet(Ressources $ressourcesOnPlanet): self
    {
        if (!$this->ressourcesOnPlanet->contains($ressourcesOnPlanet)) {
            $this->ressourcesOnPlanet[] = $ressourcesOnPlanet;
            $ressourcesOnPlanet->addWhatPlanet($this);
        }

        return $this;
    }

    public function removeRessourcesOnPlanet(Ressources $ressourcesOnPlanet): self
    {
        if ($this->ressourcesOnPlanet->contains($ressourcesOnPlanet)) {
            $this->ressourcesOnPlanet->removeElement($ressourcesOnPlanet);
            $ressourcesOnPlanet->removeWhatPlanet($this);
        }

        return $this;
    }
}
