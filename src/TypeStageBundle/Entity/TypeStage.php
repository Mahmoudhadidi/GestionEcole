<?php

namespace TypeStageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeStage
 *
 * @ORM\Table(name="type_stage", indexes={@ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="TypeStageBundle\Repository\TypeStageRepository")
 */
class TypeStage
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return TypeStage
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    public function __toString()
    {
        return  $this->type ;
    }
}

