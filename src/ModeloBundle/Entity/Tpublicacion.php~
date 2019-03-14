<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tpublicacion
 *
 * @ORM\Table(name="tpublicacion", indexes={@ORM\Index(name="fkidusuario", columns={"fkidusuario"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Tpublicacion
{
    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidpublicacion", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidpublicacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cobrado", type="boolean", nullable=false)
     */
    private $cobrado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cancelado", type="boolean", nullable=false)
     */
    private $cancelado;

    /**
     * @var string
     *
     * @ORM\Column(name="postid", type="string", length=20, nullable=true)
     */
    private $postid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alazar", type="boolean", nullable=false)
     */
    private $alazar;

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
     * @var \Tusuario
     *
     * @ORM\ManyToOne(targetEntity="Tusuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkidusuario", referencedColumnName="pkidusuario")
     * })
     */
    private $fkidusuario;



    /**
     * Get pkidpublicacion
     *
     * @return integer
     */
    public function getPkidpublicacion()
    {
        return $this->pkidpublicacion;
    }

    /**
     * Set cobrado
     *
     * @param boolean $cobrado
     *
     * @return Tpublicacion
     */
    public function setCobrado($cobrado)
    {
        $this->cobrado = $cobrado;

        return $this;
    }

    /**
     * Get cobrado
     *
     * @return boolean
     */
    public function getCobrado()
    {
        return $this->cobrado;
    }

    /**
     * Set cancelado
     *
     * @param boolean $cancelado
     *
     * @return Tpublicacion
     */
    public function setCancelado($cancelado)
    {
        $this->cancelado = $cancelado;

        return $this;
    }

    /**
     * Get cancelado
     *
     * @return boolean
     */
    public function getCancelado()
    {
        return $this->cancelado;
    }

    /**
     * Set postid
     *
     * @param string $postid
     *
     * @return Tpublicacion
     */
    public function setPostid($postid)
    {
        $this->postid = $postid;

        return $this;
    }

    /**
     * Get postid
     *
     * @return string
     */
    public function getPostid()
    {
        return $this->postid;
    }

    /**
     * Set alazar
     *
     * @param boolean $alazar
     *
     * @return Tpublicacion
     */
    public function setAlazar($alazar)
    {
        $this->alazar = $alazar;

        return $this;
    }

    /**
     * Get alazar
     *
     * @return boolean
     */
    public function getAlazar()
    {
        return $this->alazar;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Tpublicacion
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
     * @return Tpublicacion
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
     * Set fkidusuario
     *
     * @param \ModeloBundle\Entity\Tusuario $fkidusuario
     *
     * @return Tpublicacion
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
