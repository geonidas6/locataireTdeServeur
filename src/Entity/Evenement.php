<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DH\DoctrineAuditBundle\Annotation\Auditable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 * @Auditable()
 */
class Evenement
{

    const TYPE_CONCOUR = 'TYPE_CONCOUR';
    const TYPE_EXAMEN = 'TYPE_EXAMEN';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaObject", mappedBy="evenement")
     */
    private $MediaObject;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidat", mappedBy="evenement")
     */
    private $candidats;

    public function __construct()
    {
        $this->MediaObject = new ArrayCollection();
        $this->candidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }




    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }





    /**
     * @return Collection|MediaObject[]
     */
    public function getMediaObject(): Collection
    {
        return $this->MediaObject;
    }

    public function addMediaObject(MediaObject $mediaObject): self
    {
        if (!$this->MediaObject->contains($mediaObject)) {
            $this->MediaObject[] = $mediaObject;
            $mediaObject->setEvenement($this);
        }

        return $this;
    }

    public function removeMediaObject(MediaObject $mediaObject): self
    {
        if ($this->MediaObject->contains($mediaObject)) {
            $this->MediaObject->removeElement($mediaObject);
            // set the owning side to null (unless already changed)
            if ($mediaObject->getEvenement() === $this) {
                $mediaObject->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Candidat[]
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats[] = $candidat;
            $candidat->setEvenement($this);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        if ($this->candidats->contains($candidat)) {
            $this->candidats->removeElement($candidat);
            // set the owning side to null (unless already changed)
            if ($candidat->getEvenement() === $this) {
                $candidat->setEvenement(null);
            }
        }

        return $this;
    }
}
