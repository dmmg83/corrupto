<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ttransaccionerror
 *
 * @ORM\Table(name="ttransaccionerror")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Ttransaccionerror
{

    use \ModeloBundle\Traits\PrePersistTrait;
    use \ModeloBundle\Traits\PreUpdateTrait;
    use \ModeloBundle\Traits\GeneralTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="pkiderror", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkiderror;

    /**
     * @var integer
     *
     * @ORM\Column(name="fkidtransaccion", type="bigint", nullable=true)
     */
    private $fkidtransaccion;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="string", length=500, nullable=true)
     */
    private $error;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=true)
     */
    private $createdat;



    /**
     * Get pkiderror
     *
     * @return integer
     */
    public function getPkiderror()
    {
        return $this->pkiderror;
    }

    /**
     * Set fkidtransaccion
     *
     * @param integer $fkidtransaccion
     *
     * @return Ttransaccionerror
     */
    public function setFkidtransaccion($fkidtransaccion)
    {
        $this->fkidtransaccion = $fkidtransaccion;

        return $this;
    }

    /**
     * Get fkidtransaccion
     *
     * @return integer
     */
    public function getFkidtransaccion()
    {
        return $this->fkidtransaccion;
    }

    /**
     * Set error
     *
     * @param string $error
     *
     * @return Ttransaccionerror
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Ttransaccionerror
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
