<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Thistorialjugadas
 *
 * @ORM\Table(name="thistorialjugadas", indexes={@ORM\Index(name="fkidempresa", columns={"fkidempresa"}), @ORM\Index(name="fkiduduario", columns={"fkidusuario"}), @ORM\Index(name="thistorialjugadas_ibfk_3", columns={"fkidcupon"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Thistorialjugadas
{
    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidhistorial", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidhistorial;

    /**
     * @var string
     *
     * @ORM\Column(name="premio", type="string", length=100, nullable=false)
     */
    private $premio;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", length=100, nullable=false)
     */
    private $condicion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vence", type="datetime", nullable=true)
     */
    private $vence;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=1, nullable=false)
     */
    private $tipo;

    /**
     * @var \Tusuario
     *
     * @ORM\ManyToOne(targetEntity="Tusuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkidusuario", referencedColumnName="pkidusuario")
     * })
     */
    private $fkidusuario;

    /**
     * @var \Tempresa
     *
     * @ORM\ManyToOne(targetEntity="Tempresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkidempresa", referencedColumnName="pkidempresa")
     * })
     */
    private $fkidempresa;

    /**
     * @var \Tempresacupon
     *
     * @ORM\ManyToOne(targetEntity="Tempresacupon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkidcupon", referencedColumnName="pkidempresacupon")
     * })
     */
    private $fkidcupon;



    /**
     * Get pkidhistorial
     *
     * @return integer
     */
    public function getPkidhistorial()
    {
        return $this->pkidhistorial;
    }

    /**
     * Set premio
     *
     * @param string $premio
     *
     * @return Thistorialjugadas
     */
    public function setPremio($premio)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return string
     */
    public function getPremio()
    {
        return $this->premio;
    }

    /**
     * Set condicion
     *
     * @param string $condicion
     *
     * @return Thistorialjugadas
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get condicion
     *
     * @return string
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Thistorialjugadas
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set vence
     *
     * @param \DateTime $vence
     *
     * @return Thistorialjugadas
     */
    public function setVence($vence)
    {
        $this->vence = $vence;

        return $this;
    }

    /**
     * Get vence
     *
     * @return \DateTime
     */
    public function getVence()
    {
        return $this->vence;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Thistorialjugadas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fkidusuario
     *
     * @param \ModeloBundle\Entity\Tusuario $fkidusuario
     *
     * @return Thistorialjugadas
     */
    public function setFkidusuario(\ModeloBundle\Entity\Tusuario $fkidusuario = null)
    {
        $this->fkidusuario = $fkidusuario;

        return $this;
    }

    /**
     * Get fkidusuario
     *
     * @return \ModeloBundle\Entity\Tusuario
     */
    public function getFkidusuario()
    {
        return $this->fkidusuario;
    }

    /**
     * Set fkidempresa
     *
     * @param \ModeloBundle\Entity\Tempresa $fkidempresa
     *
     * @return Thistorialjugadas
     */
    public function setFkidempresa(\ModeloBundle\Entity\Tempresa $fkidempresa = null)
    {
        $this->fkidempresa = $fkidempresa;

        return $this;
    }

    /**
     * Get fkidempresa
     *
     * @return \ModeloBundle\Entity\Tempresa
     */
    public function getFkidempresa()
    {
        return $this->fkidempresa;
    }

    /**
     * Set fkidcupon
     *
     * @param \ModeloBundle\Entity\Tempresacupon $fkidcupon
     *
     * @return Thistorialjugadas
     */
    public function setFkidcupon(\ModeloBundle\Entity\Tempresacupon $fkidcupon = null)
    {
        $this->fkidcupon = $fkidcupon;

        return $this;
    }

    /**
     * Get fkidcupon
     *
     * @return \ModeloBundle\Entity\Tempresacupon
     */
    public function getFkidcupon()
    {
        return $this->fkidcupon;
    }
}
