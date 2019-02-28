<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $imageIndexName;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $imageShowName;

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

public function getImageIndexName()
{
    return $this->imageIndexName;
}

public function setImageIndexName($imageIndexName)
{
    $this->imageIndexName = $imageIndexName;

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

}
