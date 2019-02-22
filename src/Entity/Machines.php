<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MachinesRepository")
 */
class Machines
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
 * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", mappedBy="whatMachines")
 */
private $ressourecsForMachine;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Vehicles", mappedBy="machineWhoCreateVehicles")
 */
private $vehiclesByMachine;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Objects", mappedBy="machineWhoCreateObjects")
 */
private $objectsByMachine;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Machines", inversedBy="machinesByMachine")
 * @ORM\JoinColumn(nullable=true)
 */
private $machineWhoCreateMachines;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Machines", mappedBy="machineWhoCreateMachines")
 */
private $machinesByMachine;

public function __construct()
{
$this->ressourecsForMachine = new ArrayCollection();
$this->vehiclesByMachine = new ArrayCollection();
$this->objectsByMachine = new ArrayCollection();
$this->machinesByMachine = new ArrayCollection();
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
public function getRessourecsForMachine(): Collection
{
return $this->ressourecsForMachine;
}

public function addRessourecsForMachine(Ressources $ressourecsForMachine): self
{
if (!$this->ressourecsForMachine->contains($ressourecsForMachine)) {
$this->ressourecsForMachine[] = $ressourecsForMachine;
$ressourecsForMachine->addWhatMachine($this);
}

return $this;
}

public function removeRessourecsForMachine(Ressources $ressourecsForMachine): self
{
if ($this->ressourecsForMachine->contains($ressourecsForMachine)) {
$this->ressourecsForMachine->removeElement($ressourecsForMachine);
$ressourecsForMachine->removeWhatMachine($this);
}

return $this;
}

/**
 * @return Collection|Vehicles[]
 */
public function getVehiclesByMachine(): Collection
{
return $this->vehiclesByMachine;
}

public function addVehiclesByMachine(Vehicles $vehiclesByMachine): self
{
if (!$this->vehiclesByMachine->contains($vehiclesByMachine)) {
$this->vehiclesByMachine[] = $vehiclesByMachine;
$vehiclesByMachine->setMachineWhoCreateVehicles($this);
}

return $this;
}

public function removeVehiclesByMachine(Vehicles $vehiclesByMachine): self
{
if ($this->vehiclesByMachine->contains($vehiclesByMachine)) {
$this->vehiclesByMachine->removeElement($vehiclesByMachine);
// set the owning side to null (unless already changed)
if ($vehiclesByMachine->getMachineWhoCreateVehicles() === $this) {
$vehiclesByMachine->setMachineWhoCreateVehicles(null);
}
}

return $this;
}

/**
 * @return Collection|Objects[]
 */
public function getObjectsByMachine(): Collection
{
return $this->objectsByMachine;
}

public function addObjectsByMachine(Objects $objectsByMachine): self
{
if (!$this->objectsByMachine->contains($objectsByMachine)) {
$this->objectsByMachine[] = $objectsByMachine;
$objectsByMachine->setMachineWhoCreateObjects($this);
}

return $this;
}

public function removeObjectsByMachine(Objects $objectsByMachine): self
{
if ($this->objectsByMachine->contains($objectsByMachine)) {
$this->objectsByMachine->removeElement($objectsByMachine);
// set the owning side to null (unless already changed)
if ($objectsByMachine->getMachineWhoCreateObjects() === $this) {
$objectsByMachine->setMachineWhoCreateObjects(null);
}
}

return $this;
}

public function getMachineWhoCreateMachines(): ?self
{
return $this->machineWhoCreateMachines;
}

public function setMachineWhoCreateMachines(?self $machineWhoCreateMachines): self
{
$this->machineWhoCreateMachines = $machineWhoCreateMachines;

return $this;
}

/**
 * @return Collection|self[]
 */
public function getMachinesByMachine(): Collection
{
return $this->machinesByMachine;
}

public function addMachinesByMachine(self $machinesByMachine): self
{
if (!$this->machinesByMachine->contains($machinesByMachine)) {
$this->machinesByMachine[] = $machinesByMachine;
$machinesByMachine->setMachineWhoCreateMachines($this);
}

return $this;
}

public function removeMachinesByMachine(self $machinesByMachine): self
{
if ($this->machinesByMachine->contains($machinesByMachine)) {
$this->machinesByMachine->removeElement($machinesByMachine);
// set the owning side to null (unless already changed)
if ($machinesByMachine->getMachineWhoCreateMachines() === $this) {
$machinesByMachine->setMachineWhoCreateMachines(null);
}
}

return $this;
}
}
