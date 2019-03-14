<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tciudad
 *
 * @ORM\Table(name="tciudad", indexes={@ORM\Index(name="fkiddepartamento", columns={"fkiddepartamento"})})
 * @ORM\Entity
 */
class Tciudad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidciudad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreciudad", type="string", length=50, nullable=false)
     */
    private $nombreciudad;

    /**
     * @var \Tdepartamento
     *
     * @ORM\ManyToOne(targetEntity="Tdepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkiddepartamento", referencedColumnName="pkiddepartamento")
     * })
     */
    private $fkiddepartamento;



    /**
     * Get pkidciudad
     *
     * @return integer
     */
    public function getPkidciudad()
    {
        return $this->pkidciudad;
    }

    /**
     * Set nombreciudad
     *
     * @param string $nombreciudad
     *
     * @return Tciudad
     */
    public function setNombreciudad($nombreciudad)
    {
        $this->nombreciudad = $nombreciudad;

        return $this;
    }

    /**
     * Get nombreciudad
     *
     * @return string
     */
    public function getNombreciudad()
    {
        return $this->nombreciudad;
    }

    /**
     * Set fkiddepartamento
     *
     * @param \ModeloBundle\Entity\Tdepartamento $fkiddepartamento
     *
     * @return Tciudad
     */
    public function setFkiddepartamento(\ModeloBundle\Entity\Tdepartamento $fkiddepartamento = null)
    {
        $this->fkiddepartamento = $fkiddepartamento;

        return $this;
    }

    /**
     * Get fkiddepartamento
     *
     * @return \ModeloBundle\Entity\Tdepartamento
     */
    public function getFkiddepartamento()
    {
        return $this->fkiddepartamento;
    }
}
