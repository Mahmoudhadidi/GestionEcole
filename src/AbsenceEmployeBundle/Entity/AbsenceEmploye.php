<?php

namespace AbsenceEmployeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbsenceEmploye
 *
 * @ORM\Table(name="absence_employe", indexes={@ORM\Index(name="id_employe", columns={"id_employe"})})
 * @ORM\Entity
 */
class AbsenceEmploye
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_absence_e", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAbsenceE;

    /**
     * @var string
     *
     * @ORM\Column(name="type_absence", type="string", length=50, nullable=false)
     */
    private $typeAbsence;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_employe", type="integer", nullable=false)
     */
    private $idEmploye;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=125, nullable=true)
     */
    private $date;

    /**
     * @return int
     */
    public function getIdAbsenceE()
    {
        return $this->idAbsenceE;
    }

    /**
     * @param int $idAbsenceE
     */
    public function setIdAbsenceE($idAbsenceE)
    {
        $this->idAbsenceE = $idAbsenceE;
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

    /**
     * @return int
     */
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }

    /**
     * @param int $idEmploye
     */
    public function setIdEmploye($idEmploye)
    {
        $this->idEmploye = $idEmploye;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}

