<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tusuario
 *
 * @ORM\Table(name="tusuario")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Tusuario
{
    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidusuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=false)
     */
    private $telefono;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activousuario", type="boolean", nullable=false)
     */
    private $activousuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="vidas", type="integer", nullable=true)
     */
    private $vidas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultimavezalazar", type="datetime", nullable=true)
     */
    private $ultimavezalazar;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=false)
     */
    private $edad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     */
    private $updatedat;

    /**
     * @var string
     *
     * @ORM\Column(name="imei", type="string", length=50, nullable=true)
     */
    private $imei;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=true)
     */
    private $createdat;



    /**
     * Get pkidusuario
     *
     * @return integer
     */
    public function getPkidusuario()
    {
        return $this->pkidusuario;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tusuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Tusuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set activousuario
     *
     * @param boolean $activousuario
     *
     * @return Tusuario
     */
    public function setActivousuario($activousuario)
    {
        $this->activousuario = $activousuario;

        return $this;
    }

    /**
     * Get activousuario
     *
     * @return boolean
     */
    public function getActivousuario()
    {
        return $this->activousuario;
    }

    /**
     * Set vidas
     *
     * @param integer $vidas
     *
     * @return Tusuario
     */
    public function setVidas($vidas)
    {
        $this->vidas = $vidas;

        return $this;
    }

    /**
     * Get vidas
     *
     * @return integer
     */
    public function getVidas()
    {
        return $this->vidas;
    }

    /**
     * Set ultimavezalazar
     *
     * @param \DateTime $ultimavezalazar
     *
     * @return Tusuario
     */
    public function setUltimavezalazar($ultimavezalazar)
    {
        $this->ultimavezalazar = $ultimavezalazar;

        return $this;
    }

    /**
     * Get ultimavezalazar
     *
     * @return \DateTime
     */
    public function getUltimavezalazar()
    {
        return $this->ultimavezalazar;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Tusuario
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Tusuario
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
     * Set imei
     *
     * @param string $imei
     *
     * @return Tusuario
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return string
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Tusuario
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Tusuario
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
}
