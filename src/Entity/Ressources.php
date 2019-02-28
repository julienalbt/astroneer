<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RessourcesRepository")
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
 * @ORM\ManyToMany(targetEntity="App\Entity\Machines", inversedBy="ressourcesForMachine")
 */
private $whatMachines;

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

/**
 * @ORM\Column(type="boolean")
 */
private $isItExchangeable;

/**
 * @ORM\Column(type="boolean")
 */
private $isItProducible;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 * @Assert\File(mimeTypes={ "image/jpeg" })
 */
private $imageShowName;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 * @Assert\File(mimeTypes={ "image/jpeg" })
 */
private $imageIndexName;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Machines", mappedBy="ressourcesByMachine")
 */
private $ressourcesCreatedByMachine;

public function __construct()
{
$this->whatPlanets = new ArrayCollection();
$this->whatVehicles = new ArrayCollection();
$this->whatObjects = new ArrayCollection();
$this->whatMachines = new ArrayCollection();
$this->ressourcesForRessource = new ArrayCollection();
$this->ressourcesCreateByRessources = new ArrayCollection();
$this->ressourcesCreatedByMachine = new ArrayCollection();
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

public function getIsItExchangeable(): ?bool
{
return $this->isItExchangeable;
}

public function setIsItExchangeable(bool $isItExchangeable): self
{
$this->isItExchangeable = $isItExchangeable;

return $this;
}

public function getIsItProducible(): ?bool
{
return $this->isItProducible;
}

public function setIsItProducible(bool $isItProducible): self
{
$this->isItProducible = $isItProducible;

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
 * @return Collection|Machines[]
 */
public function getRessourcesCreatedByMachine(): Collection
{
    return $this->ressourcesCreatedByMachine;
}

public function addRessourcesCreatedByMachine(Machines $ressourcesCreatedByMachine): self
{
    if (!$this->ressourcesCreatedByMachine->contains($ressourcesCreatedByMachine)) {
        $this->ressourcesCreatedByMachine[] = $ressourcesCreatedByMachine;
        $ressourcesCreatedByMachine->addRessourcesByMachine($this);
    }

    return $this;
}

public function removeRessourcesCreatedByMachine(Machines $ressourcesCreatedByMachine): self
{
    if ($this->ressourcesCreatedByMachine->contains($ressourcesCreatedByMachine)) {
        $this->ressourcesCreatedByMachine->removeElement($ressourcesCreatedByMachine);
        $ressourcesCreatedByMachine->removeRessourcesByMachine($this);
    }

    return $this;
}

}
