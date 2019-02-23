<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MachinesRepository")
 * @Vich\Uploadable
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
 *
 * @Vich\UploadableField(mapping="machines_images", fileNameProperty="imageName", size="imageSize")
 *
 * @var File
 */
private $imageFile;

/**
 * @ORM\Column(type="string", length=100, nullable=true)
 *
 * @var string
 */
private $imageName;

/**
 * @ORM\Column(type="integer", nullable=true)
 *
 * @var integer
 */
private $imageSize;

/**
 * @ORM\Column(type="datetime", nullable=true)
 *
 * @var \DateTime
 */
private $updatedAt;

public function __construct()
{
$this->ressourcesForMachine = new ArrayCollection();
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

/**
 * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
 * of 'UploadedFile' is injected into this setter to trigger the update. If this
 * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
 * must be able to accept an instance of 'File' as the bundle will inject one here
 * during Doctrine hydration.
 *
 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
 */
public function setImageFile(?File $imageFile = null): void
{
$this->imageFile = $imageFile;

if (null !== $imageFile) {
// It is required that at least one field changes if you are using doctrine
// otherwise the event listeners won't be called and the file is lost
$this->updatedAt = new \DateTimeImmutable();
}
}

public function getImageFile(): ?File
{
return $this->imageFile;
}

public function setImageName(?string $imageName): void
{
$this->imageName = $imageName;
}

public function getImageName(): ?string
{
return $this->imageName;
}

public function setImageSize(?int $imageSize): void
{
$this->imageSize = $imageSize;
}

public function getImageSize(): ?int
{
return $this->imageSize;
}

}
