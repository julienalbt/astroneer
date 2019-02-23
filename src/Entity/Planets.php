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
 * @ORM\Entity(repositoryClass="App\Repository\PlanetsRepository")
 * @Vich\Uploadable
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
 *
 * @Vich\UploadableField(mapping="planets_images", fileNameProperty="imageName", size="imageSize")
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
