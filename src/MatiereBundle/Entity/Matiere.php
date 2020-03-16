<?php

namespace MatiereBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity
 */
class Matiere
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_matiere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMatiere;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_matier", type="string", length=30, nullable=false)
     */
    private $nomMatier;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=false)
     */
    private $coefficient;

    /**
     * @var integer
     *
     * @ORM\Column(name="cdedit", type="integer", nullable=false)
     */
    private $cdedit;

    /**
     * @return int
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param int $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return string
     */
    public function getNomMatier()
    {
        return $this->nomMatier;
    }

    /**
     * @param string $nomMatier
     */
    public function setNomMatier($nomMatier)
    {
        $this->nomMatier = $nomMatier;
    }

    /**
     * @return int
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @param int $coefficient
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * @return int
     */
    public function getCdedit()
    {
        return $this->cdedit;
    }

    /**
     * @param int $cdedit
     */
    public function setCdedit($cdedit)
    {
        $this->cdedit = $cdedit;
    }


}

