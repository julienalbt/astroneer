<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $imageShowName;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $imageIndexName;

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

}
