<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     *
     * @ORM\Column(name="note_cc", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteCc = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="note_ds", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteDs = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="note_examun", type="float", precision=10, scale=0, nullable=false)
     */
    private $noteExamun;

    /**
     * @var float
     *
     * @ORM\Column(name="moyenne", type="float", precision=10, scale=0, nullable=true)
     */
    private $moyenne = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="net", type="float", precision=10, scale=0, nullable=true)
     */
    private $net = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_matier", type="string", length=255, nullable=false)
     */
    private $nomMatier;


}

