<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

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
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="date_naissance", type="string", length=50, nullable=false)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=false)
     */
    private $adresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;

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
    private $salair = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="salair2", type="float", precision=10, scale=0, nullable=true)
     */
    private $salair2 = 'NULL';


}

