<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReleveNote
 *
 * @ORM\Table(name="releve_note")
 * @ORM\Entity
 */
class ReleveNote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_releve", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReleve;

    /**
     * @var float
     *
     * @ORM\Column(name="note_ccc", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteCcc = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="note_dss", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteDss = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="note_examenn", type="float", precision=10, scale=0, nullable=false)
     */
    private $noteExamenn;

    /**
     * @var float
     *
     * @ORM\Column(name="moy", type="float", precision=10, scale=0, nullable=false)
     */
    private $moy;

    /**
     * @var float
     *
     * @ORM\Column(name="nette", type="float", precision=10, scale=0, nullable=false)
     */
    private $nette;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_mat", type="string", length=30, nullable=false)
     */
    private $nomMat;

    /**
     * @var integer
     *
     * @ORM\Column(name="coeff", type="integer", nullable=false)
     */
    private $coeff;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="second_name", type="string", length=50, nullable=false)
     */
    private $secondName;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_userr", type="integer", nullable=false)
     */
    private $idUserr;


}

