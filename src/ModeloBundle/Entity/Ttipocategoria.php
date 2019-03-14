<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ttipocategoria
 *
 * @ORM\Table(name="ttipocategoria")
 * @ORM\Entity
 */
class Ttipocategoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidtipocategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidtipocategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombretipocategoria", type="string", length=100, nullable=false)
     */
    private $nombretipocategoria;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Activotipocategoria", type="boolean", nullable=false)
     */
    private $activotipocategoria;



    /**
     * Get pkidtipocategoria
     *
     * @return integer
     */
    public function getPkidtipocategoria()
    {
        return $this->pkidtipocategoria;
    }

    /**
     * Set nombretipocategoria
     *
     * @param string $nombretipocategoria
     *
     * @return Ttipocategoria
     */
    public function setNombretipocategoria($nombretipocategoria)
    {
        $this->nombretipocategoria = $nombretipocategoria;

        return $this;
    }

    /**
     * Get nombretipocategoria
     *
     * @return string
     */
    public function getNombretipocategoria()
    {
        return $this->nombretipocategoria;
    }

    /**
     * Set activotipocategoria
     *
     * @param boolean $activotipocategoria
     *
     * @return Ttipocategoria
     */
    public function setActivotipocategoria($activotipocategoria)
    {
        $this->activotipocategoria = $activotipocategoria;

        return $this;
    }

    /**
     * Get activotipocategoria
     *
     * @return boolean
     */
    public function getActivotipocategoria()
    {
        return $this->activotipocategoria;
    }
}
