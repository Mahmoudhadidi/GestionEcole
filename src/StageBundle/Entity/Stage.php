<?php

namespace StageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stage
 *
 * @ORM\Table(name="stage", indexes={@ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="StageBundle\Repository\StageRepository")
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
     * @var \TypeStage
     *
     * @ORM\ManyToOne(targetEntity="TypeStageBundle\Entity\TypeStage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @return int
     */
    public function getIdStage()
    {
        return $this->idStage;
    }

    /**
     * @param int $idStage
     */
    public function setIdStage($idStage)
    {
        $this->idStage = $idStage;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebutS()
    {
        return $this->datedebutS;
    }

    /**
     * @param \DateTime $datedebutS
     */
    public function setDatedebutS($datedebutS)
    {
        $this->datedebutS = $datedebutS;
    }

    /**
     * @return \DateTime
     */
    public function getDatefinS()
    {
        return $this->datefinS;
    }

    /**
     * @param \DateTime $datefinS
     */
    public function setDatefinS($datefinS)
    {
        $this->datefinS = $datefinS;
    }

    /**
     * @return int
     */
    public function getCapaciteMax()
    {
        return $this->capaciteMax;
    }

    /**
     * @param int $capaciteMax
     */
    public function setCapaciteMax($capaciteMax)
    {
        $this->capaciteMax = $capaciteMax;
    }

    /**
     * @return \TypeStage
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \TypeStage $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


}

