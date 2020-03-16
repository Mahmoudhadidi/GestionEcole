<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seance
 *
 * @ORM\Table(name="seance", indexes={@ORM\Index(name="id_ens", columns={"id_ens", "id_classe", "id_matiere", "id_salle"})})
 * @ORM\Entity
 */
class Seance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_seance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSeance;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ens", type="integer", nullable=false)
     */
    private $idEns;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_classe", type="integer", nullable=false)
     */
    private $idClasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_matiere", type="integer", nullable=false)
     */
    private $idMatiere;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_salle", type="integer", nullable=false)
     */
    private $idSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=30, nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=30, nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=30, nullable=false)
     */
    private $date;


}

