<?php

namespace ModeloBundle\Traits;

trait PrePersistTrait{

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // date_default_timezone_set('America/Bogota');
        $this->createdat = new \DateTime();
    }
}
