<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubRepository")
 */
class Club
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_etudiant", type="integer")
     */
    private $idEtudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_couverture", type="string", length=50)
     */
    public $photoCouverture;
    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=50)
     */
    public $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string", length=50)
     */
    private $slogan;

    /**
     * @var string
     *
     * @ORM\Column(name="grand_titre", type="string", length=50)
     */
    private $grandTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50)
     */
    private $etat;
    /**
     * @Assert\File(maxSize="99999999k")
     */
    public $file;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEtudiant
     *
     * @param integer $idEtudiant
     *
     * @return Club
     */
    public function setIdEtudiant($idEtudiant)
    {
        $this->idEtudiant = $idEtudiant;

        return $this;
    }

    /**
     * Get idEtudiant
     *
     * @return int
     */
    public function getIdEtudiant()
    {
        return $this->idEtudiant;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Club
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set photoCouverture
     *
     * @param string $photoCouverture
     *
     * @return Club
     */
    public function setPhotoCouverture($photoCouverture)
    {
        $this->photoCouverture = $photoCouverture;

        return $this;
    }

    /**
     * Get photoCouverture
     *
     * @return string
     */
    public function getPhotoCouverture()
    {
        return $this->photoCouverture;
    }
    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Club
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set slogan
     *
     * @param string $slogan
     *
     * @return Club
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get slogan
     *
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set grandTitre
     *
     * @param string $grandTitre
     *
     * @return Club
     */
    public function setGrandTitre($grandTitre)
    {
        $this->grandTitre = $grandTitre;

        return $this;
    }

    /**
     * Get grandTitre
     *
     * @return string
     */
    public function getGrandTitre()
    {
        return $this->grandTitre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Club
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Club
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Club
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../GestionEcole/web/images';
    }
    public function uploadProfilePicture()
    {
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        //$this->nomImage=$this->file->getClientOriginalName();
        //$this->file=null;
    }


}

