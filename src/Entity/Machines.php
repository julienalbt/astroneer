<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
private $ressourcesForMachine;

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

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $imageShowName;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $imageIndexName;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", inversedBy="ressourcesCreatedByMachine")
 */
private $ressourcesByMachine;

public function __construct()
{
$this->ressourcesForMachine = new ArrayCollection();
$this->vehiclesByMachine = new ArrayCollection();
$this->objectsByMachine = new ArrayCollection();
$this->machinesByMachine = new ArrayCollection();
$this->ressourcesByMachine = new ArrayCollection();
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
public function getRessourcesForMachine(): Collection
{
return $this->ressourcesForMachine;
}

public function addRessourcesForMachine(Ressources $ressourcesForMachine): self
{
if (!$this->ressourcesForMachine->contains($ressourcesForMachine)) {
$this->ressourcesForMachine[] = $ressourcesForMachine;
$ressourcesForMachine->addWhatMachine($this);
}

return $this;
}

public function removeRessourcesForMachine(Ressources $ressourcesForMachine): self
{
if ($this->ressourcesForMachine->contains($ressourcesForMachine)) {
$this->ressourcesForMachine->removeElement($ressourcesForMachine);
$ressourcesForMachine->removeWhatMachine($this);
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

public function getImageShowName()
{
    return $this->imageShowName;
}

public function setImageShowName($imageShowName)
{
    $this->imageShowName = $imageShowName;

    return $this;
}

public function getImageIndexName()
{
    return $this->imageIndexName;
}

public function setImageIndexName($imageIndexName)
{
    $this->imageIndexName = $imageIndexName;

    return $this;
}

function str_to_noaccent($str) {
$url = $str;
$url = preg_replace('#Ç#', 'C', $url);
$url = preg_replace('#ç#', 'c', $url);
$url = preg_replace('#è|é|ê|ë#', 'e', $url);
$url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
$url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
$url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
$url = preg_replace('#ì|í|î|ï#', 'i', $url);
$url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
$url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
$url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
$url = preg_replace('#ù|ú|û|ü#', 'u', $url);
$url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
$url = preg_replace('#ý|ÿ#', 'y', $url);
$url = preg_replace('#Ý#', 'Y', $url);

return ($url);
}

/**
 * @return Collection|Ressources[]
 */
public function getRessourcesByMachine(): Collection
{
    return $this->ressourcesByMachine;
}

public function addRessourcesByMachine(Ressources $ressourcesByMachine): self
{
    if (!$this->ressourcesByMachine->contains($ressourcesByMachine)) {
        $this->ressourcesByMachine[] = $ressourcesByMachine;
    }

    return $this;
}

public function removeRessourcesByMachine(Ressources $ressourcesByMachine): self
{
    if ($this->ressourcesByMachine->contains($ressourcesByMachine)) {
        $this->ressourcesByMachine->removeElement($ressourcesByMachine);
    }

    return $this;
}

}
