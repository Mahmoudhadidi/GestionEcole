<?php

namespace UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 *  @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=50, nullable=true)
     */
    private $login = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=50, nullable=true)
     */
    private $mdp = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=30, nullable=true)
     */
    private $role = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom= 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom= 'NULL';



    /**
     * @var string
     *
     * @ORM\Column(name="date_naissance", type="string", length=50, nullable=false)
     */
    private $dateNaissance= 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=false)
     */
    private $adresse= 'NULL';

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


    /**
     * @return string
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param string $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param string $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return int
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * @param int $idClasse
     */
    public function setIdClasse($idClasse)
    {
        $this->idClasse = $idClasse;
    }

    /**
     * @return float
     */
    public function getSalair()
    {
        return $this->salair;
    }

    /**
     * @param float $salair
     */
    public function setSalair($salair)
    {
        $this->salair = $salair;
    }

    /**
     * @return float
     */
    public function getSalair2()
    {
        return $this->salair2;
    }

    /**
     * @param float $salair2
     */
    public function setSalair2($salair2)
    {
        $this->salair2 = $salair2;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin= 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=50, nullable=true)
     */
    private $niveau = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_classe", type="integer", nullable=true)
     */
    private $idClasse = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="salair", type="float", precision=10, scale=0, nullable=true)
     */
    private $salair = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="salair2", type="float", precision=10, scale=0, nullable=true)
     */
    private $salair2 = '0';


}

