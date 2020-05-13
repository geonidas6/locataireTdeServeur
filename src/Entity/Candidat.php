<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DH\DoctrineAuditBundle\Annotation\Auditable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CandidatRepository")
 * @Auditable()
 */
class Candidat
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_naissance;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prefeture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_centre_concour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etablissement_de_provenance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jury;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filier_serie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matier_eliminer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $amphi;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $numero_salle;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $semestre;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="candidats")
     */
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): self
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getPrefeture(): ?string
    {
        return $this->prefeture;
    }

    public function setPrefeture(?string $prefeture): self
    {
        $this->prefeture = $prefeture;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getLieuCentreConcour(): ?string
    {
        return $this->lieu_centre_concour;
    }

    public function setLieuCentreConcour(string $lieu_centre_concour): self
    {
        $this->lieu_centre_concour = $lieu_centre_concour;

        return $this;
    }

    public function getEtablissementDeProvenance(): ?string
    {
        return $this->etablissement_de_provenance;
    }

    public function setEtablissementDeProvenance(string $etablissement_de_provenance): self
    {
        $this->etablissement_de_provenance = $etablissement_de_provenance;

        return $this;
    }

    public function getJury(): ?string
    {
        return $this->jury;
    }

    public function setJury(?string $jury): self
    {
        $this->jury = $jury;

        return $this;
    }

    public function getFilierSerie(): ?string
    {
        return $this->filier_serie;
    }

    public function setFilierSerie(?string $filier_serie): self
    {
        $this->filier_serie = $filier_serie;

        return $this;
    }

    public function getMatierEliminer(): ?string
    {
        return $this->matier_eliminer;
    }

    public function setMatierEliminer(?string $matier_eliminer): self
    {
        $this->matier_eliminer = $matier_eliminer;

        return $this;
    }

    public function getAmphi(): ?string
    {
        return $this->amphi;
    }

    public function setAmphi(?string $amphi): self
    {
        $this->amphi = $amphi;

        return $this;
    }

    public function getNumeroSalle(): ?string
    {
        return $this->numero_salle;
    }

    public function setNumeroSalle(?string $numero_salle): self
    {
        $this->numero_salle = $numero_salle;

        return $this;
    }

    public function getSemestre(): ?string
    {
        return $this->semestre;
    }

    public function setSemestre(?string $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }



    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
