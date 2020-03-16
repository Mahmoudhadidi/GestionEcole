<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="absence", indexes={@ORM\Index(name="id_seance", columns={"id_seance", "id_etudiant"})})
 * @ORM\Entity
 */
class Absence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_absence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAbsence;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_seance", type="integer", nullable=false)
     */
    private $idSeance;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_etudiant", type="integer", nullable=false)
     */
    private $idEtudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="type_absence", type="string", length=50, nullable=false)
     */
    private $typeAbsence;


}

