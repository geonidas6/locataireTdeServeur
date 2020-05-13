<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DH\DoctrineAuditBundle\Annotation\Auditable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @Auditable()
 * @ApiFilter(SearchFilter::class, properties={"username": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{


    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN_LOCAL = 'ROLE_ADMIN_LOCAL';
    const ROLE_SUPER_USER = 'ROLE_SUPER_USER';
    const ROLE_USER = 'ROLE_USER';
    const PORFIL_TRANSITAIRE = 'PORFIL_TRANSITAIRE';
    const PORFIL_EXPORTATEUR = 'PORFIL_EXPORTATEUR';
    const PORFIL_VALIDATEUR = 'PORFIL_VALIDATEUR';
    const PORFIL_CAISSIER = 'PORFIL_CAISSIER';
    const PORFIL_CERTIFICATEUR = 'PORFIL_CERTIFICATEUR';
    const PORFIL_SUPERVISEUR = 'PORFIL_SUPERVISEUR';
    const PORFIL_ADMINISTRATEUR = 'PORFIL_ADMINISTRATEUR';
    const PORFIL_AGENT_CONTROLEUR = 'PORFIL_AGENT_CONTROLEUR';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const MOD_PAIEMENT_MENSUEL = 'MOD_PAIEMENT_MENSUEL';
    const MOD_PAIEMENT_INSTANTANEE = 'MOD_PAIEMENT_INSTANTANEE';


    const Femme = 'Femme';
    const Homme = 'Homme';
    const defaultDialcode = '225';
    const dev_admin_password = "ghJKK355HJ";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [User::ROLE_USER];

    /**
     * @Assert\NotBlank(message="Vous devez remplir ce champ")
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiToken;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir votre nom")
     */
    private $lastName ;

    /**
     * @var string
     *
     * @ORM\Column(name="prenoms", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir vos prénoms")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, unique=true)
     * @Assert\NotBlank(message="L'identifiant est obligatoire")
     */
    private $username;



    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled=false;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=false)
     */
    private $sexe ;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     */
    private $tel ;

    /**
     * @var string
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $dateAjout ;

    /**
     * @var string
     *
     * @ORM\Column(name="dialcode", type="string", length=255, nullable=true )
     */
    private $dialcode;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true )
     */
    private $adresse;



    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked=false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidat", mappedBy="createBy")
     */
    private $candidats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="createBy")
     */
    private $evenements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaObject", mappedBy="user")
     */
    private $MediaObject;







    public function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }


    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->createBy = new ArrayCollection();
        $this->candidats = new ArrayCollection();
        $this->evenements = new ArrayCollection();
        $this->MediaObject = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }



    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken): void
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($password): void
    {
        $this->plainPassword = $password;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return(string)  $this->lastName ;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return(string)  $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getSexe(): string
    {
        return(string)  $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe(string $sexe): void
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getTel(): string
    {
        return(string)  $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel(string $tel): void
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getDateAjout(): ?\DateTimeInterface
    {
        return  $this->dateAjout;
    }

    /**
     *
     * @param string $dateAjout
     */
    public function setDateAjout( $dateAjout): void
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return string
     */
    public function getDialcode(): string
    {
        return(string)  $this->dialcode;
    }

    /**
     * @param string $dialcode
     */
    public function setDialcode(string $dialcode): void
    {
        $this->dialcode = $dialcode;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return(string)  $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }




    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked): void
    {
        $this->locked = $locked;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(?string $profil): self
    {
        $this->profil = $profil;

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
            $candidat->setCreateBy($this);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        if ($this->candidats->contains($candidat)) {
            $this->candidats->removeElement($candidat);
            // set the owning side to null (unless already changed)
            if ($candidat->getCreateBy() === $this) {
                $candidat->setCreateBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setCreateBy($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->contains($evenement)) {
            $this->evenements->removeElement($evenement);
            // set the owning side to null (unless already changed)
            if ($evenement->getCreateBy() === $this) {
                $evenement->setCreateBy(null);
            }
        }

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function getLocked(): ?bool
    {
        return $this->locked;
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
            $mediaObject->setUser($this);
        }

        return $this;
    }

    public function removeMediaObject(MediaObject $mediaObject): self
    {
        if ($this->MediaObject->contains($mediaObject)) {
            $this->MediaObject->removeElement($mediaObject);
            // set the owning side to null (unless already changed)
            if ($mediaObject->getUser() === $this) {
                $mediaObject->setUser(null);
            }
        }

        return $this;
    }







}
