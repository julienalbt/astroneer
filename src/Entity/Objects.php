<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjectsRepository")
 */
class Objects
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
 * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", mappedBy="whatObjects")
 */
private $ressourcesForObject;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Machines", inversedBy="objectsByMachine")
 * @ORM\JoinColumn(nullable=false)
 */
private $machineWhoCreateObjects;

public function __construct()
{
$this->ressourcesForObject = new ArrayCollection();
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
public function getRessourcesForObject(): Collection
{
return $this->ressourcesForObject;
}

public function addRessourcesForObject(Ressources $ressourcesForObject): self
{
if (!$this->ressourcesForObject->contains($ressourcesForObject)) {
$this->ressourcesForObject[] = $ressourcesForObject;
$ressourcesForObject->addWhatObject($this);
}

return $this;
}

public function removeRessourcesForObject(Ressources $ressourcesForObject): self
{
if ($this->ressourcesForObject->contains($ressourcesForObject)) {
$this->ressourcesForObject->removeElement($ressourcesForObject);
$ressourcesForObject->removeWhatObject($this);
}

return $this;
}

public function getMachineWhoCreateObjects(): ?Machines
{
return $this->machineWhoCreateObjects;
}

public function setMachineWhoCreateObjects(?Machines $machineWhoCreateObjects): self
{
$this->machineWhoCreateObjects = $machineWhoCreateObjects;

return $this;
}

}
