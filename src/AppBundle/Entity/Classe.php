<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", indexes={@ORM\Index(name="num_classe", columns={"num_classe"}), @ORM\Index(name="num_classe_2", columns={"num_classe"})})
 * @ORM\Entity
 */
class Classe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_classe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasse;

    /**
     * @var string
     *
     * @ORM\Column(name="num_classe", type="string", length=30, nullable=false)
     */
    private $numClasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_etudient", type="integer", nullable=false)
     */
    private $nbreEtudient;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=30, nullable=false)
     */
    private $specialite;


}

