<?php

namespace AbsenceBundle\Entity;

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

    /**
     * @return int
     */
    public function getIdAbsence()
    {
        return $this->idAbsence;
    }

    /**
     * @param int $idAbsence
     */
    public function setIdAbsence($idAbsence)
    {
        $this->idAbsence = $idAbsence;
    }

    /**
     * @return int
     */
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * @param int $idSeance
     */
    public function setIdSeance($idSeance)
    {
        $this->idSeance = $idSeance;
    }

    /**
     * @return int
     */
    public function getIdEtudiant()
    {
        return $this->idEtudiant;
    }

    /**
     * @param int $idEtudiant
     */
    public function setIdEtudiant($idEtudiant)
    {
        $this->idEtudiant = $idEtudiant;
    }

    /**
     * @return string
     */
    public function getTypeAbsence()
    {
        return $this->typeAbsence;
    }

    /**
     * @param string $typeAbsence
     */
    public function setTypeAbsence($typeAbsence)
    {
        $this->typeAbsence = $typeAbsence;
    }


}

