<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tconfiguracion
 *
 * @ORM\Table(name="tconfiguracion")
 * @ORM\Entity
 */
class Tconfiguracion
{
    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=300, nullable=false)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechacambio", type="datetime", nullable=false)
     */
    private $fechacambio;

    /**
     * @var string
     *
     * @ORM\Column(name="valoranterior", type="string", length=300, nullable=false)
     */
    private $valoranterior;



    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Tconfiguracion
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set fechacambio
     *
     * @param \DateTime $fechacambio
     *
     * @return Tconfiguracion
     */
    public function setFechacambio($fechacambio)
    {
        $this->fechacambio = $fechacambio;

        return $this;
    }

    /**
     * Get fechacambio
     *
     * @return \DateTime
     */
    public function getFechacambio()
    {
        return $this->fechacambio;
    }

    /**
     * Set valoranterior
     *
     * @param string $valoranterior
     *
     * @return Tconfiguracion
     */
    public function setValoranterior($valoranterior)
    {
        $this->valoranterior = $valoranterior;

        return $this;
    }

    /**
     * Get valoranterior
     *
     * @return string
     */
    public function getValoranterior()
    {
        return $this->valoranterior;
    }
}
