<?php

namespace ModeloBundle\Traits;

trait PreUpdateTrait{

    /**
     * @ORM\PreUpdate
     */
    public function setUpdateAtValue()
    {
        // date_default_timezone_set('America/Bogota');
        $this->updatedat = new \DateTime();
    }
}