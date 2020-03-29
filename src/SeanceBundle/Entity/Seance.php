<?php

namespace SeanceBundle\Entity;

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
     * @ORM\Column(name="heure", type="time", length=30, nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="date", length=30, nullable=false)
     */
    private $date;

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
    public function getIdEns()
    {
        return $this->idEns;
    }

    /**
     * @param int $idEns
     */
    public function setIdEns($idEns)
    {
        $this->idEns = $idEns;
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
     * @return int
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param int $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }

    /**
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param string $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param string $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
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

