<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tcategoriaempresa
 *
 * @ORM\Table(name="tcategoriaempresa", indexes={@ORM\Index(name="fkidempresa", columns={"fkidempresa"}), @ORM\Index(name="fkidcategoria", columns={"fkidcategoria"})})
 * @ORM\Entity
 */
class Tcategoriaempresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pkidcategoriaemoresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkidcategoriaemoresa;

    /**
     * @var \Ttipocategoria
     *
     * @ORM\ManyToOne(targetEntity="Ttipocategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkidcategoria", referencedColumnName="pkidtipocategoria")
     * })
     */
    private $fkidcategoria;

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
     * Get pkidcategoriaemoresa
     *
     * @return integer
     */
    public function getPkidcategoriaemoresa()
    {
        return $this->pkidcategoriaemoresa;
    }

    /**
     * Set fkidcategoria
     *
     * @param \ModeloBundle\Entity\Ttipocategoria $fkidcategoria
     *
     * @return Tcategoriaempresa
     */
    public function setFkidcategoria(\ModeloBundle\Entity\Ttipocategoria $fkidcategoria = null)
    {
        $this->fkidcategoria = $fkidcategoria;

        return $this;
    }

    /**
     * Get fkidcategoria
     *
     * @return \ModeloBundle\Entity\Ttipocategoria
     */
    public function getFkidcategoria()
    {
        return $this->fkidcategoria;
    }

    /**
     * Set fkidempresa
     *
     * @param \ModeloBundle\Entity\Tempresa $fkidempresa
     *
     * @return Tcategoriaempresa
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
