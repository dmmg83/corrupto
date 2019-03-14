<?php

namespace ModeloBundle\Traits;

trait ControllerTrait{


    /**
     * Esta función se ejecuta en dos fases:
     * 1.   Valida los campos que son pedidos en el json (todos). Es decir es similar a 
     *      validar que exista el campo con isset($campo).
     * 2.   Valida que los campos requeridos no sean nulos o vacíos, por defecto valida todos,
     *      si existen campos opcionales (que pueden ir nulos o vacíos), se debe especificar cuale son.
     *
     * @param object    $json       El json recibido por request después de haber sido decodificado con json_decode
     * @param array     $campos     Los campos que deben estar contenidos en el json.
     * @param array     $opcionales Los campos que no son obligatorios y pueden ir vacios o null.
     * @return array    Retorna un array con los campos obligatorios que llegaron null o vacíos.
     *                  Sólo retornará el nombre de los campos en caso de estar en ambiente de pruebas.
     *                  En ambiente de producción retornará la posición del campo en el array campo, 
     *                  que puede ser diferente a la posición en el json, por lo que para depurar hay que 
     *                  ver el código fuente.
     */
    private function validarCampos($json, array $campos, array $opcionales=null) : array {
        
        $camposNull = array();
        
        $vars=\get_object_vars($json);

        $i=0;
        foreach ($campos as $campo) {
            $i++;
            if(!array_key_exists($campo, $vars))
            {
                throw new \Exception("Error en el json: Falta el campo '$campo'. Los valores esperados son: ".\implode(', ', $campos));
            }
            elseif(!is_bool($json->$campo) && !is_numeric($json->$campo) && empty($json->$campo))
            {
                if($this->container->getParameter('kernel.environment')=='dev')
                {
                    $camposNull[] = $campo;
                }
                else {
                    $camposNull[] = $i;
                }
            }
        }

        return $camposNull;
    }
}
