<?php

namespace CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seance
 *
 * @ORM\Table(name="seance", indexes={@ORM\Index(name="id_ens", columns={"id_ens", "id_classe", "id_matiere", "id_salle"}), @ORM\Index(name="id_ens_2", columns={"id_ens"}), @ORM\Index(name="id_classe", columns={"id_classe"}), @ORM\Index(name="id_matiere", columns={"id_matiere"}), @ORM\Index(name="id_salle", columns={"id_salle"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="SeanceBundle\Repository\SeanceRepository")
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
     * @var string
     *
     * @ORM\Column(name="duree", type="datetime", length=30, nullable=false)
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
     * @ORM\Column(name="date", type="datetime", length=30, nullable=false)
     */
    private $date;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ens", referencedColumnName="id")
     * })
     */
    private $idEns;

    /**
     * @var \Classe
     *
     * @ORM\ManyToOne(targetEntity="ClasseBundle\Entity\Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_classe", referencedColumnName="id_classe")
     * })
     */
    private $idClasse;

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="MatiereBundle\Entity\Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idMatiere;

    /**
     * @var \Salle
     *
     * @ORM\ManyToOne(targetEntity="SalleBundle\Entity\Salle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_salle", referencedColumnName="id_salle")
     * })
     */
    private $idSalle;

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

    /**
     * @return \User
     */
    public function getIdEns()
    {
        return $this->idEns;
    }

    /**
     * @param \User $idEns
     */
    public function setIdEns($idEns)
    {
        $this->idEns = $idEns;
    }

    /**
     * @return \Classe
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * @param \Classe $idClasse
     */
    public function setIdClasse($idClasse)
    {
        $this->idClasse = $idClasse;
    }

    /**
     * @return \Matiere
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param \Matiere $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return \Salle
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param \Salle $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }


}

