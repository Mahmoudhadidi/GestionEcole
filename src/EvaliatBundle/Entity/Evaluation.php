<?php

namespace EvaliatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation")
 * @ORM\Entity
 */
class Evaluation
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
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="id_etd", type="integer", nullable=false)
     */
    private $idEtd;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\GreaterThanOrEqual(value="0", message="Saisie une valeur Positive SVP !!")
     * @ORM\Column(name="presence", type="string", length=30, nullable=false)
     */
    private $presence;

    /**
     * @var string
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="rendement", type="string", length=30, nullable=false)
     */
    private $rendement;

    /**
     * @var string
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="discipline", type="string", length=30, nullable=false)
     */
    private $discipline;

    /**
     * @var string
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="nom_matiere", type="string", length=50, nullable=false)
     */
    private $nomMatiere;

    /**
     * @var integer
     * @Assert\GreaterThanOrEqual(value="0", message="Saisie une valeur Positive SVP !!")
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="id_enseignant", type="integer", nullable=false)
     */
    private $idEnseignant;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdEtd()
    {
        return $this->idEtd;
    }

    /**
     * @param int $idEtd
     */
    public function setIdEtd(int $idEtd): void
    {
        $this->idEtd = $idEtd;
    }

    /**
     * @return string
     */
    public function getPresence()
    {
        return $this->presence;
    }

    /**
     * @param string $presence
     */
    public function setPresence(string $presence): void
    {
        $this->presence = $presence;
    }

    /**
     * @return string
     */
    public function getRendement()
    {
        return $this->rendement;
    }

    /**
     * @param string $rendement
     */
    public function setRendement(string $rendement): void
    {
        $this->rendement = $rendement;
    }

    /**
     * @return string
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param string $discipline
     */
    public function setDiscipline(string $discipline): void
    {
        $this->discipline = $discipline;
    }

    /**
     * @return string
     */
    public function getNomMatiere()
    {
        return $this->nomMatiere;
    }

    /**
     * @param string $nomMatiere
     */
    public function setNomMatiere(string $nomMatiere): void
    {
        $this->nomMatiere = $nomMatiere;
    }

    /**
     * @return int
     */
    public function getIdEnseignant()
    {
        return $this->idEnseignant;
    }

    /**
     * @param int $idEnseignant
     */
    public function setIdEnseignant(int $idEnseignant): void
    {
        $this->idEnseignant = $idEnseignant;
    }


}

