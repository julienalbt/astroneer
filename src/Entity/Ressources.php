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
 * @ORM\Entity(repositoryClass="App\Repository\RessourcesRepository")
 * @Vich\Uploadable
 */
class Ressources
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
 * @ORM\ManyToMany(targetEntity="App\Entity\Planets", inversedBy="ressourcesOnPlanet")
 */
private $whatPlanets;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Vehicles", inversedBy="ressourcesForVehicle")
 */
private $whatVehicles;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Objects", inversedBy="ressourcesForObject")
 */
private $whatObjects;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Machines", inversedBy="ressourecsForMachine")
 */
private $whatMachines;

/**
 *
 * @Vich\UploadableField(mapping="ressources_images", fileNameProperty="imageName", size="imageSize")
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

/**
 * @ORM\Column(type="string", length=35)
 */
private $origin;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", inversedBy="ressourcesCreateByRessources")
 */
private $ressourcesForRessource;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Ressources", mappedBy="ressourcesForRessource")
 */
private $ressourcesCreateByRessources;

public function __construct()
{
$this->whatPlanets = new ArrayCollection();
$this->whatVehicles = new ArrayCollection();
$this->whatObjects = new ArrayCollection();
$this->whatMachines = new ArrayCollection();
$this->ressourcesForRessource = new ArrayCollection();
$this->ressourcesCreateByRessources = new ArrayCollection();
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
 * @return Collection|Planets[]
 */
public function getWhatPlanets(): Collection
{
return $this->whatPlanets;
}

public function addWhatPlanet(Planets $whatPlanet): self
{
if (!$this->whatPlanets->contains($whatPlanet)) {
$this->whatPlanets[] = $whatPlanet;
}

return $this;
}

public function removeWhatPlanet(Planets $whatPlanet): self
{
if ($this->whatPlanets->contains($whatPlanet)) {
$this->whatPlanets->removeElement($whatPlanet);
}

return $this;
}

/**
 * @return Collection|Vehicles[]
 */
public function getWhatVehicles(): Collection
{
return $this->whatVehicles;
}

public function addWhatVehicle(Vehicles $whatVehicle): self
{
if (!$this->whatVehicles->contains($whatVehicle)) {
$this->whatVehicles[] = $whatVehicle;
}

return $this;
}

public function removeWhatVehicle(Vehicles $whatVehicle): self
{
if ($this->whatVehicles->contains($whatVehicle)) {
$this->whatVehicles->removeElement($whatVehicle);
}

return $this;
}

/**
 * @return Collection|Objects[]
 */
public function getWhatObjects(): Collection
{
return $this->whatObjects;
}

public function addWhatObject(Objects $whatObject): self
{
if (!$this->whatObjects->contains($whatObject)) {
$this->whatObjects[] = $whatObject;
}

return $this;
}

public function removeWhatObject(Objects $whatObject): self
{
if ($this->whatObjects->contains($whatObject)) {
$this->whatObjects->removeElement($whatObject);
}

return $this;
}

/**
 * @return Collection|Machines[]
 */
public function getWhatMachines(): Collection
{
return $this->whatMachines;
}

public function addWhatMachine(Machines $whatMachine): self
{
if (!$this->whatMachines->contains($whatMachine)) {
$this->whatMachines[] = $whatMachine;
}

return $this;
}

public function removeWhatMachine(Machines $whatMachine): self
{
if ($this->whatMachines->contains($whatMachine)) {
$this->whatMachines->removeElement($whatMachine);
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

public function getOrigin(): ?string
{
    return $this->origin;
}

public function setOrigin(string $origin): self
{
    $this->origin = $origin;

    return $this;
}

/**
 * @return Collection|self[]
 */
public function getRessourcesForRessource(): Collection
{
    return $this->ressourcesForRessource;
}

public function addRessourcesForRessource(self $ressourcesForRessource): self
{
    if (!$this->ressourcesForRessource->contains($ressourcesForRessource)) {
        $this->ressourcesForRessource[] = $ressourcesForRessource;
    }

    return $this;
}

public function removeRessourcesForRessource(self $ressourcesForRessource): self
{
    if ($this->ressourcesForRessource->contains($ressourcesForRessource)) {
        $this->ressourcesForRessource->removeElement($ressourcesForRessource);
    }

    return $this;
}

/**
 * @return Collection|self[]
 */
public function getRessourcesCreateByRessources(): Collection
{
    return $this->ressourcesCreateByRessources;
}

public function addRessourcesCreateByRessource(self $ressourcesCreateByRessource): self
{
    if (!$this->ressourcesCreateByRessources->contains($ressourcesCreateByRessource)) {
        $this->ressourcesCreateByRessources[] = $ressourcesCreateByRessource;
        $ressourcesCreateByRessource->addRessourcesForRessource($this);
    }

    return $this;
}

public function removeRessourcesCreateByRessource(self $ressourcesCreateByRessource): self
{
    if ($this->ressourcesCreateByRessources->contains($ressourcesCreateByRessource)) {
        $this->ressourcesCreateByRessources->removeElement($ressourcesCreateByRessource);
        $ressourcesCreateByRessource->removeRessourcesForRessource($this);
    }

    return $this;
}

}
