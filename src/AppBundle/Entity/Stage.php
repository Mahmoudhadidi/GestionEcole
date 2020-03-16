<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stage
 *
 * @ORM\Table(name="stage", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Stage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_stage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEDEBUT_S", type="date", nullable=false)
     */
    private $datedebutS;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEFIN_S", type="date", nullable=false)
     */
    private $datefinS;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacite_max", type="integer", nullable=false)
     */
    private $capaciteMax;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_stage", type="string", length=255, nullable=false)
     */
    private $niveauStage;


}

