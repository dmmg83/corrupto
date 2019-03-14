<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ttipocupon
 *
 * @ORM\Table(name="ttipocupon")
 * @ORM\Entity
 */
class Ttipocupon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidTipocupon", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidtipocupon;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreTipocupon", type="string", length=100, nullable=false)
     */
    private $nombretipocupon;

    /**
     * @var string
     *
     * @ORM\Column(name="IconoTipocupon", type="string", length=255, nullable=true)
     */
    private $iconotipocupon;

     /**
     * @var string
     *
     * @ORM\Column(name="premio", type="string", length=200, nullable=true)
     */
    private $premio;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", length=200, nullable=true)
     */
    private $condicion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ActivoTipocupon", type="boolean", nullable=false)
     */
    private $activotipocupon;



    /**
     * Get pkidtipocupon
     *
     * @return integer
     */
    public function getPkidtipocupon()
    {
        return $this->pkidtipocupon;
    }

    /**
     * Set nombretipocupon
     *
     * @param string $nombretipocupon
     *
     * @return Ttipocupon
     */
    public function setNombretipocupon($nombretipocupon)
    {
        $this->nombretipocupon = $nombretipocupon;

        return $this;
    }

    /**
     * Get nombretipocupon
     *
     * @return string
     */
    public function getNombretipocupon()
    {
        return $this->nombretipocupon;
    }

    /**
     * Set iconotipocupon
     *
     * @param string $iconotipocupon
     *
     * @return Ttipocupon
     */
    public function setIconotipocupon($iconotipocupon)
    {
        $this->iconotipocupon = $iconotipocupon;

        return $this;
    }

    /**
     * Get iconotipocupon
     *
     * @return string
     */
    public function getIconotipocupon()
    {
        return $this->iconotipocupon;
    }

    /**
     * Set activotipocupon
     *
     * @param boolean $activotipocupon
     *
     * @return Ttipocupon
     */
    public function setActivotipocupon($activotipocupon)
    {
        $this->activotipocupon = $activotipocupon;

        return $this;
    }

    /**
     * Get activotipocupon
     *
     * @return boolean
     */
    public function getActivotipocupon()
    {
        return $this->activotipocupon;
    }

    /**
     * Get the value of premio
     *
     * @return  string
     */ 
    public function getPremio()
    {
        return $this->premio;
    }

    /**
     * Set the value of premio
     *
     * @param  string  $premio
     *
     * @return  self
     */ 
    public function setPremio(string $premio)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get the value of condicion
     *
     * @return  string
     */ 
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set the value of condicion
     *
     * @param  string  $condicion
     *
     * @return  self
     */ 
    public function setCondicion(string $condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }
}
