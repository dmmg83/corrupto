<?php

namespace ModeloBundle\Traits;

use Firebase\JWT\JWT;

trait JwtTrait{
    
    public function checkToken($jwt)
    {
        //se crea un objeto para  que contendrá si es válido y el usuario.
        $auth = new class {
        public $valido = false; 
        public $usuario = null;
        };
    
        try {
            
            $auth->usuario = JWT::decode($jwt, $this->key, array('HS256'));
        
            $auth->valido = (is_object($auth->usuario) && isset($auth->usuario->sub));
    
        } catch (\UnexpectedValueException $th) {
            $this->logger->error('ERROR AUTHENTICACION: ' . $th->getMessage());
        } catch (\DomainException $th) {
            $this->logger->error('ERROR AUTHENTICACION: ' . $th->getMessage());
        } catch (\Throwable $th) {
            $this->logger->error('CheckToken Error: ' . $th->getMessage());
        }
        return $auth;
    }
}
