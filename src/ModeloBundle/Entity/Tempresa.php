<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tempresa
 *
 * @ORM\Table(name="tempresa", indexes={@ORM\Index(name="fkiddepartamento", columns={"fkiddepartamento"}), @ORM\Index(name="fkidciudad", columns={"fkidciudad"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Tempresa
{
    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidempresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidempresa;

    /**
     * @var integer
     *
     * @ORM\Column(name="fkiddepartamento", type="integer", nullable=true)
     */
    private $fkiddepartamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="fkidciudad", type="integer", nullable=true)
     */
    private $fkidciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=200, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=true)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=50, nullable=true)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=120, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonos", type="string", length=60, nullable=true)
     */
    private $telefonos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=110, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activoempresa", type="boolean", nullable=false)
     */
    private $activoempresa = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cuentaconfirmada", type="boolean", nullable=false)
     */
    private $cuentaconfirmada = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var integer
     *
     * @ORM\Column(name="cuponespermitidos", type="integer", nullable=false)
     */
    private $cuponespermitidos = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="logo", type="boolean", nullable=true)
     */
    private $logo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tienecupones", type="boolean", nullable=false)
     */
    private $tienecupones = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="catsalud", type="boolean", nullable=false)
     */
    private $catsalud = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="catmascotas", type="boolean", nullable=false)
     */
    private $catmascotas = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="catropa", type="boolean", nullable=false)
     */
    private $catropa = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cathogar", type="boolean", nullable=false)
     */
    private $cathogar = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cattecnologia", type="boolean", nullable=false)
     */
    private $cattecnologia = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="catvehiculos", type="boolean", nullable=false)
     */
    private $catvehiculos = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cattiendas", type="boolean", nullable=false)
     */
    private $cattiendas = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="catrestaurantes", type="boolean", nullable=false)
     */
    private $catrestaurantes = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="shakes", type="integer", nullable=false)
     */
    private $shakes = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="saldototal", type="boolean", nullable=false)
     */
    private $saldototal = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     */
    private $updatedat;



    /**
     * Get pkidempresa
     *
     * @return integer
     */
    public function getPkidempresa()
    {
        return $this->pkidempresa;
    }

    /**
     * Set fkiddepartamento
     *
     * @param integer $fkiddepartamento
     *
     * @return Tempresa
     */
    public function setFkiddepartamento($fkiddepartamento)
    {
        $this->fkiddepartamento = $fkiddepartamento;

        return $this;
    }

    /**
     * Get fkiddepartamento
     *
     * @return integer
     */
    public function getFkiddepartamento()
    {
        return $this->fkiddepartamento;
    }

    /**
     * Set fkidciudad
     *
     * @param integer $fkidciudad
     *
     * @return Tempresa
     */
    public function setFkidciudad($fkidciudad)
    {
        $this->fkidciudad = $fkidciudad;

        return $this;
    }

    /**
     * Get fkidciudad
     *
     * @return integer
     */
    public function getFkidciudad()
    {
        return $this->fkidciudad;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Tempresa
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Tempresa
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

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
     * Set nit
     *
     * @param string $nit
     *
     * @return Tempresa
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tempresa
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Tempresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     *
     * @return Tempresa
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;

        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tempresa
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set activoempresa
     *
     * @param boolean $activoempresa
     *
     * @return Tempresa
     */
    public function setActivoempresa($activoempresa)
    {
        $this->activoempresa = $activoempresa;

        return $this;
    }

    /**
     * Get activoempresa
     *
     * @return boolean
     */
    public function getActivoempresa()
    {
        return $this->activoempresa;
    }

    /**
     * Set cuentaconfirmada
     *
     * @param boolean $cuentaconfirmada
     *
     * @return Tempresa
     */
    public function setCuentaconfirmada($cuentaconfirmada)
    {
        $this->cuentaconfirmada = $cuentaconfirmada;

        return $this;
    }

    /**
     * Get cuentaconfirmada
     *
     * @return boolean
     */
    public function getCuentaconfirmada()
    {
        return $this->cuentaconfirmada;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Tempresa
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
     * Set cuponespermitidos
     *
     * @param integer $cuponespermitidos
     *
     * @return Tempresa
     */
    public function setCuponespermitidos($cuponespermitidos)
    {
        $this->cuponespermitidos = $cuponespermitidos;

        return $this;
    }

    /**
     * Get cuponespermitidos
     *
     * @return integer
     */
    public function getCuponespermitidos()
    {
        return $this->cuponespermitidos;
    }

    /**
     * Set logo
     *
     * @param boolean $logo
     *
     * @return Tempresa
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return boolean
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set tienecupones
     *
     * @param boolean $tienecupones
     *
     * @return Tempresa
     */
    public function setTienecupones($tienecupones)
    {
        $this->tienecupones = $tienecupones;

        return $this;
    }

    /**
     * Get tienecupones
     *
     * @return boolean
     */
    public function getTienecupones()
    {
        return $this->tienecupones;
    }

    /**
     * Set catsalud
     *
     * @param boolean $catsalud
     *
     * @return Tempresa
     */
    public function setCatsalud($catsalud)
    {
        $this->catsalud = $catsalud;

        return $this;
    }

    /**
     * Get catsalud
     *
     * @return boolean
     */
    public function getCatsalud()
    {
        return $this->catsalud;
    }

    /**
     * Set catmascotas
     *
     * @param boolean $catmascotas
     *
     * @return Tempresa
     */
    public function setCatmascotas($catmascotas)
    {
        $this->catmascotas = $catmascotas;

        return $this;
    }

    /**
     * Get catmascotas
     *
     * @return boolean
     */
    public function getCatmascotas()
    {
        return $this->catmascotas;
    }

    /**
     * Set catropa
     *
     * @param boolean $catropa
     *
     * @return Tempresa
     */
    public function setCatropa($catropa)
    {
        $this->catropa = $catropa;

        return $this;
    }

    /**
     * Get catropa
     *
     * @return boolean
     */
    public function getCatropa()
    {
        return $this->catropa;
    }

    /**
     * Set cathogar
     *
     * @param boolean $cathogar
     *
     * @return Tempresa
     */
    public function setCathogar($cathogar)
    {
        $this->cathogar = $cathogar;

        return $this;
    }

    /**
     * Get cathogar
     *
     * @return boolean
     */
    public function getCathogar()
    {
        return $this->cathogar;
    }

    /**
     * Set cattecnologia
     *
     * @param boolean $cattecnologia
     *
     * @return Tempresa
     */
    public function setCattecnologia($cattecnologia)
    {
        $this->cattecnologia = $cattecnologia;

        return $this;
    }

    /**
     * Get cattecnologia
     *
     * @return boolean
     */
    public function getCattecnologia()
    {
        return $this->cattecnologia;
    }

    /**
     * Set catvehiculos
     *
     * @param boolean $catvehiculos
     *
     * @return Tempresa
     */
    public function setCatvehiculos($catvehiculos)
    {
        $this->catvehiculos = $catvehiculos;

        return $this;
    }

    /**
     * Get catvehiculos
     *
     * @return boolean
     */
    public function getCatvehiculos()
    {
        return $this->catvehiculos;
    }

    /**
     * Set cattiendas
     *
     * @param boolean $cattiendas
     *
     * @return Tempresa
     */
    public function setCattiendas($cattiendas)
    {
        $this->cattiendas = $cattiendas;

        return $this;
    }

    /**
     * Get cattiendas
     *
     * @return boolean
     */
    public function getCattiendas()
    {
        return $this->cattiendas;
    }

    /**
     * Set catrestaurantes
     *
     * @param boolean $catrestaurantes
     *
     * @return Tempresa
     */
    public function setCatrestaurantes($catrestaurantes)
    {
        $this->catrestaurantes = $catrestaurantes;

        return $this;
    }

    /**
     * Get catrestaurantes
     *
     * @return boolean
     */
    public function getCatrestaurantes()
    {
        return $this->catrestaurantes;
    }

    /**
     * Set shakes
     *
     * @param integer $shakes
     *
     * @return Tempresa
     */
    public function setShakes($shakes)
    {
        $this->shakes = $shakes;

        return $this;
    }

    /**
     * Get shakes
     *
     * @return integer
     */
    public function getShakes()
    {
        return $this->shakes;
    }

    /**
     * Set saldototal
     *
     * @param boolean $saldototal
     *
     * @return Tempresa
     */
    public function setSaldototal($saldototal)
    {
        $this->saldototal = $saldototal;

        return $this;
    }

    /**
     * Get saldototal
     *
     * @return boolean
     */
    public function getSaldototal()
    {
        return $this->saldototal;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Tempresa
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
}
