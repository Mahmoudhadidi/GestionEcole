<?php

namespace NotesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Note
 *
 * @ORM\Table(name="note", indexes={@ORM\Index(name="id_user", columns={"cin", "nom_matier"})})
 * @ORM\Entity
 */
class Note
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_note", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNote;

    /**
     * @var float
     * @Assert\GreaterThanOrEqual(value="0", message="Entrer une valeur entre [0,20]")
     * @Assert\LessThanOrEqual(value="20", message="Entrer une valeur entre [0,20]")
     * @ORM\Column(name="note_cc", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteCc;

    /**
     * @var float
     * @Assert\GreaterThanOrEqual(value="0", message="Entrer une valeur entre [0,20]")
     * @Assert\LessThanOrEqual(value="20", message="Entrer une valeur entre [0,20]")
     * @ORM\Column(name="note_ds", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteDs ;

    /**
     * @var float
     *
     * @ORM\Column(name="note_examun", type="float", precision=10, scale=0, nullable=false)
     */
    private $noteExamun;

    /**
     * @var float
     * @Assert\GreaterThanOrEqual(value="0", message="Entrer une valeur entre [0,20]")
     * @Assert\LessThanOrEqual(value="20", message="Entrer une valeur entre [0,20]")
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="moyenne", type="float", precision=10, scale=0, nullable=true)
     */
    private $moyenne ;

    /**
     * @var float
     *
     * @ORM\Column(name="net", type="float", precision=10, scale=0, nullable=true)
     */
    private $net ;

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;

    /**
     * @var string
     *@Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="nom_matier", type="string", length=255, nullable=false)
     */
    private $nomMatier;

    /**
     * @return int
     */
    public function getIdNote(): int
    {
        return $this->idNote;
    }

    /**
     * @param int $idNote
     */
    public function setIdNote(int $idNote): void
    {
        $this->idNote = $idNote;
    }

    /**
     * @return float
     */
    public function getNoteCc()
    {
        return $this->noteCc;
    }

    /**
     * @param float $noteCc
     */
    public function setNoteCc(float $noteCc)
    {
        $this->noteCc = $noteCc;
    }

    /**
     * @return float
     */
    public function getNoteDs()
    {
        return $this->noteDs;
    }

    /**
     * @param float $noteDs
     */
    public function setNoteDs(float $noteDs)
    {
        $this->noteDs = $noteDs;
    }

    /**
     * @return float
     */
    public function getNoteExamun()
    {
        return $this->noteExamun;
    }

    /**
     * @param float $noteExamun
     */
    public function setNoteExamun(float $noteExamun)
    {
        $this->noteExamun = $noteExamun;
    }

    /**
     * @return float
     */
    public function getMoyenne()
    {
        return $this->moyenne;
    }

    /**
     * @param float $moyenne
     */
    public function setMoyenne(float $moyenne): void
    {
        $this->moyenne = $moyenne;
    }

    /**
     * @return float
     */
    public function getNet()    {
        return $this->net;
    }

    /**
     * @param float $net
     */
    public function setNet(float $net): void
    {
        $this->net = $net;
    }

    /**
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     */
    public function setCin(int $cin)
    {
        $this->cin = $cin;
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
    public function setNomMatier(string $nomMatier)
    {
        $this->nomMatier = $nomMatier;
    }


}

