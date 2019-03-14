<?php

namespace ModeloBundle\Traits;

trait GeneralTrait{
    
    private $entityBundle='ModeloBundle';

    /**
     * Función para asignar las propiedades de una entidad de forma automatizada
     *
     * @param $json recibe el json con los nombres de los atributos y los valores asignados a cada uno. Es case-sensitive y los atributos deben coincidir con los de la entidad.
     * @param $em en caso de requerir una inserción de un objeto de la bd (relación) debe proporcionarse un EntityManager
     * @param array $ignorar los atributos que la función debe ignorar. Estos se ignoran porque se les dará un manejo específico dentro de la lógica.
     * @return void
     */
    public function autoSet($json, $em=null, array $ignorar=null)
    {
        $vars=\get_object_vars($json);


        foreach ($vars as $variable=>$valor) {
            
            // echo "<p>$variable:$valor (".\gettype($valor).")</p>";

            if(strpos($variable,'id') === 0) continue;
            
            if($ignorar!=null && !empty($ignorar) && in_array($variable, $ignorar)) continue;

            if(strpos($variable,'fkid') === 0) {
                
                if($valor!=null && is_object($em))
                {

                    //echo "valor=$valor";
                    //$entidad = ucfirst(substr($variable,4));
                    $entidad = 'T'.substr($variable,4);
                    $this->$variable = $em->getRepository("$this->entityBundle:$entidad")->find($valor);
                    // echo '<p>';
                    // \var_dump($this->$variable);
                    // echo '</p>';
                    continue;
                }
                elseif (!is_object($em)) {
                    throw new \Exception("Se reicibió una llave fkid pero no se recibió un objeto em.");
                }
                elseif ($valor==null) {
                    throw new \Exception("Se reicibió una llave fkid pero se recibió valor nulo.");
                }
            }
            
            $this->$variable = is_string($valor) ? trim($valor) : $valor;
        }
    }

    public function toArray():array
    {
        $vars=\get_object_vars($this);
        $rta = array();
        foreach ($vars as $variable=>$valor) {
            $rta[$variable]=$valor;
        }
        return $rta;
    }
    public function __toString()
    {
        return __CLASS__;
    }
}
