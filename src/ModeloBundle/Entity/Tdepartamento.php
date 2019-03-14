<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tdepartamento
 *
 * @ORM\Table(name="tdepartamento")
 * @ORM\Entity
 */
class Tdepartamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pkiddepartamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkiddepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombredepartamento", type="string", length=50, nullable=false)
     */
    private $nombredepartamento;



    /**
     * Get pkiddepartamento
     *
     * @return integer
     */
    public function getPkiddepartamento()
    {
        return $this->pkiddepartamento;
    }

    /**
     * Set nombredepartamento
     *
     * @param string $nombredepartamento
     *
     * @return Tdepartamento
     */
    public function setNombredepartamento($nombredepartamento)
    {
        $this->nombredepartamento = $nombredepartamento;

        return $this;
    }

    /**
     * Get nombredepartamento
     *
     * @return string
     */
    public function getNombredepartamento()
    {
        return $this->nombredepartamento;
    }
}
