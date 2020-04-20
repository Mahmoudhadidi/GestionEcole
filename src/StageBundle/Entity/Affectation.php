<?php

namespace StageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation", indexes={@ORM\Index(name="id_stage", columns={"id_stage"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="StageBundle\Repository\StageRepository")
 */
class Affectation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_stage", type="integer", nullable=false)
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
     * @ORM\Column(name="postuler", type="string", length=50, nullable=false)
     */
    private $postuler;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return string
     */
    public function getPostuler()
    {
        return $this->postuler;
    }

    /**
     * @param string $postuler
     */
    public function setPostuler($postuler)
    {
        $this->postuler = $postuler;
    }


}

