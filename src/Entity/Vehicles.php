<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiclesRepository")
 */
class Vehicles
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
 * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", mappedBy="whatVehicles")
 */
private $ressourcesForVehicle;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Machines", inversedBy="vehiclesByMachine")
 * @ORM\JoinColumn(nullable=false)
 */
private $machineWhoCreateVehicles;

public function __construct()
{
$this->ressourcesForVehicle = new ArrayCollection();
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
public function getRessourcesForVehicle(): Collection
{
return $this->ressourcesForVehicle;
}

public function addRessourcesForVehicle(Ressources $ressourcesForVehicle): self
{
if (!$this->ressourcesForVehicle->contains($ressourcesForVehicle)) {
$this->ressourcesForVehicle[] = $ressourcesForVehicle;
$ressourcesForVehicle->addWhatVehicle($this);
}

return $this;
}

public function removeRessourcesForVehicle(Ressources $ressourcesForVehicle): self
{
if ($this->ressourcesForVehicle->contains($ressourcesForVehicle)) {
$this->ressourcesForVehicle->removeElement($ressourcesForVehicle);
$ressourcesForVehicle->removeWhatVehicle($this);
}

return $this;
}

public function getMachineWhoCreateVehicles(): ?Machines
{
return $this->machineWhoCreateVehicles;
}

public function setMachineWhoCreateVehicles(?Machines $machineWhoCreateVehicles): self
{
$this->machineWhoCreateVehicles = $machineWhoCreateVehicles;

return $this;
}
}
