<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tempresacupon
 *
 * @ORM\Table(name="tempresacupon", indexes={@ORM\Index(name="empresacupon", columns={"fkidempresa"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Tempresacupon
{
    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidempresacupon", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidempresacupon;

    /**
     * @var string
     *
     * @ORM\Column(name="fkidtipocupon", type="string", length=1, nullable=false)
     */
    private $fkidtipocupon;

    /**
     * @var string
     *
     * @ORM\Column(name="imagenpremio", type="string", length=500, nullable=true)
     */
    private $imagenpremio;

    /**
     * @var integer
     *
     * @ORM\Column(name="existencias", type="integer", nullable=false)
     */
    private $existencias;

    /**
     * @var integer
     *
     * @ORM\Column(name="sobran", type="integer", nullable=false)
     */
    private $sobran;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo", type="integer", nullable=false)
     */
    private $tiempo;

    /**
     * @var string
     *
     * @ORM\Column(name="premio", type="string", length=100, nullable=false)
     */
    private $premio;

    /**
     * @var string
     *
     * @ORM\Column(name="condicioncupon", type="string", length=100, nullable=false)
     */
    private $condicioncupon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activocupon", type="boolean", nullable=false)
     */
    private $activocupon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     */
    private $updatedat;

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
     * Get pkidempresacupon
     *
     * @return integer
     */
    public function getPkidempresacupon()
    {
        return $this->pkidempresacupon;
    }

    /**
     * Set fkidtipocupon
     *
     * @param string $fkidtipocupon
     *
     * @return Tempresacupon
     */
    public function setFkidtipocupon($fkidtipocupon)
    {
        $this->fkidtipocupon = $fkidtipocupon;

        return $this;
    }

    /**
     * Get fkidtipocupon
     *
     * @return string
     */
    public function getFkidtipocupon()
    {
        return $this->fkidtipocupon;
    }

    /**
     * Set imagenpremio
     *
     * @param string $imagenpremio
     *
     * @return Tempresacupon
     */
    public function setImagenpremio($imagenpremio)
    {
        $this->imagenpremio = $imagenpremio;

        return $this;
    }

    /**
     * Get imagenpremio
     *
     * @return string
     */
    public function getImagenpremio()
    {
        return $this->imagenpremio;
    }

    /**
     * Set existencias
     *
     * @param integer $existencias
     *
     * @return Tempresacupon
     */
    public function setExistencias($existencias)
    {
        $this->existencias = $existencias;

        return $this;
    }

    /**
     * Get existencias
     *
     * @return integer
     */
    public function getExistencias()
    {
        return $this->existencias;
    }

    /**
     * Set sobran
     *
     * @param integer $sobran
     *
     * @return Tempresacupon
     */
    public function setSobran($sobran)
    {
        $this->sobran = $sobran;

        return $this;
    }

    /**
     * Get sobran
     *
     * @return integer
     */
    public function getSobran()
    {
        return $this->sobran;
    }

    /**
     * Set tiempo
     *
     * @param integer $tiempo
     *
     * @return Tempresacupon
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return integer
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set premio
     *
     * @param string $premio
     *
     * @return Tempresacupon
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
     * Set condicioncupon
     *
     * @param string $condicioncupon
     *
     * @return Tempresacupon
     */
    public function setCondicioncupon($condicioncupon)
    {
        $this->condicioncupon = $condicioncupon;

        return $this;
    }

    /**
     * Get condicioncupon
     *
     * @return string
     */
    public function getCondicioncupon()
    {
        return $this->condicioncupon;
    }

    /**
     * Set activocupon
     *
     * @param boolean $activocupon
     *
     * @return Tempresacupon
     */
    public function setActivocupon($activocupon)
    {
        $this->activocupon = $activocupon;

        return $this;
    }

    /**
     * Get activocupon
     *
     * @return boolean
     */
    public function getActivocupon()
    {
        return $this->activocupon;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Tempresacupon
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
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Tempresacupon
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Set fkidempresa
     *
     * @param \ModeloBundle\Entity\Tempresa $fkidempresa
     *
     * @return Tempresacupon
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
}
