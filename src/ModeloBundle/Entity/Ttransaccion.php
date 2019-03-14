<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ttransaccion
 *
 * @ORM\Table(name="ttransaccion", indexes={@ORM\Index(name="fkidempresa", columns={"fkidempresa"}), @ORM\Index(name="fkidusuario", columns={"fkidusuario"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Ttransaccion
{
    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidtransaccion", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidtransaccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecharta", type="datetime", nullable=true)
     */
    private $fecharta;

    /**
     * @var string
     *
     * @ORM\Column(name="transaccionid", type="string", length=50, nullable=true)
     */
    private $transaccionid;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia1", type="string", length=50, nullable=true)
     */
    private $referencia1;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia2", type="string", length=50, nullable=true)
     */
    private $referencia2;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=100, nullable=true)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="franquicia", type="string", length=20, nullable=true)
     */
    private $franquicia;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=10, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="string", length=15, nullable=true)
     */
    private $respuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="codrespuesta", type="string", length=10, nullable=true)
     */
    private $codrespuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="codaprobacion", type="string", length=20, nullable=true)
     */
    private $codaprobacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipodoc", type="string", length=4, nullable=true)
     */
    private $tipodoc;

    /**
     * @var string
     *
     * @ORM\Column(name="doc", type="string", length=20, nullable=true)
     */
    private $doc;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=150, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="razonrespuesta", type="string", length=500, nullable=true)
     */
    private $razonrespuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="fechatransac", type="string", length=20, nullable=true)
     */
    private $fechatransac;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoerror", type="string", length=10, nullable=true)
     */
    private $codigoerror;

    /**
     * @var string
     *
     * @ORM\Column(name="extra1", type="string", length=10, nullable=true)
     */
    private $extra1;

    /**
     * @var string
     *
     * @ORM\Column(name="extra2", type="string", length=10, nullable=true)
     */
    private $extra2;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=200, nullable=true)
     */
    private $origen;

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
     * @var \Tusuario
     *
     * @ORM\ManyToOne(targetEntity="Tusuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkidusuario", referencedColumnName="pkidusuario")
     * })
     */
    private $fkidusuario;



    /**
     * Get pkidtransaccion
     *
     * @return integer
     */
    public function getPkidtransaccion()
    {
        return $this->pkidtransaccion;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Ttransaccion
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
     * Set fecharta
     *
     * @param \DateTime $fecharta
     *
     * @return Ttransaccion
     */
    public function setFecharta($fecharta)
    {
        $this->fecharta = $fecharta;

        return $this;
    }

    /**
     * Get fecharta
     *
     * @return \DateTime
     */
    public function getFecharta()
    {
        return $this->fecharta;
    }

    /**
     * Set transaccionid
     *
     * @param string $transaccionid
     *
     * @return Ttransaccion
     */
    public function setTransaccionid($transaccionid)
    {
        $this->transaccionid = $transaccionid;

        return $this;
    }

    /**
     * Get transaccionid
     *
     * @return string
     */
    public function getTransaccionid()
    {
        return $this->transaccionid;
    }

    /**
     * Set referencia1
     *
     * @param string $referencia1
     *
     * @return Ttransaccion
     */
    public function setReferencia1($referencia1)
    {
        $this->referencia1 = $referencia1;

        return $this;
    }

    /**
     * Get referencia1
     *
     * @return string
     */
    public function getReferencia1()
    {
        return $this->referencia1;
    }

    /**
     * Set referencia2
     *
     * @param string $referencia2
     *
     * @return Ttransaccion
     */
    public function setReferencia2($referencia2)
    {
        $this->referencia2 = $referencia2;

        return $this;
    }

    /**
     * Get referencia2
     *
     * @return string
     */
    public function getReferencia2()
    {
        return $this->referencia2;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Ttransaccion
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set franquicia
     *
     * @param string $franquicia
     *
     * @return Ttransaccion
     */
    public function setFranquicia($franquicia)
    {
        $this->franquicia = $franquicia;

        return $this;
    }

    /**
     * Get franquicia
     *
     * @return string
     */
    public function getFranquicia()
    {
        return $this->franquicia;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Ttransaccion
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
     * Set respuesta
     *
     * @param string $respuesta
     *
     * @return Ttransaccion
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set codrespuesta
     *
     * @param string $codrespuesta
     *
     * @return Ttransaccion
     */
    public function setCodrespuesta($codrespuesta)
    {
        $this->codrespuesta = $codrespuesta;

        return $this;
    }

    /**
     * Get codrespuesta
     *
     * @return string
     */
    public function getCodrespuesta()
    {
        return $this->codrespuesta;
    }

    /**
     * Set codaprobacion
     *
     * @param string $codaprobacion
     *
     * @return Ttransaccion
     */
    public function setCodaprobacion($codaprobacion)
    {
        $this->codaprobacion = $codaprobacion;

        return $this;
    }

    /**
     * Get codaprobacion
     *
     * @return string
     */
    public function getCodaprobacion()
    {
        return $this->codaprobacion;
    }

    /**
     * Set tipodoc
     *
     * @param string $tipodoc
     *
     * @return Ttransaccion
     */
    public function setTipodoc($tipodoc)
    {
        $this->tipodoc = $tipodoc;

        return $this;
    }

    /**
     * Get tipodoc
     *
     * @return string
     */
    public function getTipodoc()
    {
        return $this->tipodoc;
    }

    /**
     * Set doc
     *
     * @param string $doc
     *
     * @return Ttransaccion
     */
    public function setDoc($doc)
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * Get doc
     *
     * @return string
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Ttransaccion
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Ttransaccion
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Ttransaccion
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Ttransaccion
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
     * Set razonrespuesta
     *
     * @param string $razonrespuesta
     *
     * @return Ttransaccion
     */
    public function setRazonrespuesta($razonrespuesta)
    {
        $this->razonrespuesta = $razonrespuesta;

        return $this;
    }

    /**
     * Get razonrespuesta
     *
     * @return string
     */
    public function getRazonrespuesta()
    {
        return $this->razonrespuesta;
    }

    /**
     * Set fechatransac
     *
     * @param string $fechatransac
     *
     * @return Ttransaccion
     */
    public function setFechatransac($fechatransac)
    {
        $this->fechatransac = $fechatransac;

        return $this;
    }

    /**
     * Get fechatransac
     *
     * @return string
     */
    public function getFechatransac()
    {
        return $this->fechatransac;
    }

    /**
     * Set codigoerror
     *
     * @param string $codigoerror
     *
     * @return Ttransaccion
     */
    public function setCodigoerror($codigoerror)
    {
        $this->codigoerror = $codigoerror;

        return $this;
    }

    /**
     * Get codigoerror
     *
     * @return string
     */
    public function getCodigoerror()
    {
        return $this->codigoerror;
    }

    /**
     * Set extra1
     *
     * @param string $extra1
     *
     * @return Ttransaccion
     */
    public function setExtra1($extra1)
    {
        $this->extra1 = $extra1;

        return $this;
    }

    /**
     * Get extra1
     *
     * @return string
     */
    public function getExtra1()
    {
        return $this->extra1;
    }

    /**
     * Set extra2
     *
     * @param string $extra2
     *
     * @return Ttransaccion
     */
    public function setExtra2($extra2)
    {
        $this->extra2 = $extra2;

        return $this;
    }

    /**
     * Get extra2
     *
     * @return string
     */
    public function getExtra2()
    {
        return $this->extra2;
    }

    /**
     * Set origen
     *
     * @param string $origen
     *
     * @return Ttransaccion
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Ttransaccion
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
     * @return Ttransaccion
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
     * Set fkidusuario
     *
     * @param \ModeloBundle\Entity\Tusuario $fkidusuario
     *
     * @return Ttransaccion
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
}
