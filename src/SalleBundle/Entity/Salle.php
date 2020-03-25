<?php

namespace SalleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity
 *  @ORM\Entity(repositoryClass="SalleBundle\Repository\SalleRepository")
 */
class Salle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_salle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_salle", type="integer", nullable=false)
     */
    private $numSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_salle", type="string", length=30, nullable=false)
     */
    private $nomSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="bloc", type="string", length=30, nullable=false)
     */
    private $bloc;

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
     * @return int
     */
    public function getNumSalle()
    {
        return $this->numSalle;
    }

    /**
     * @param int $numSalle
     */
    public function setNumSalle($numSalle)
    {
        $this->numSalle = $numSalle;
    }

    /**
     * @return string
     */
    public function getNomSalle()
    {
        return $this->nomSalle;
    }

    /**
     * @param string $nomSalle
     */
    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;
    }

    /**
     * @return string
     */
    public function getBloc()
    {
        return $this->bloc;
    }

    /**
     * @param string $bloc
     */
    public function setBloc($bloc)
    {
        $this->bloc = $bloc;
    }


}

