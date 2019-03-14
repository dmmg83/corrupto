<?php
namespace ModeloBundle\Services;

use Firebase\JWT\JWT;
use Psr\Log\LoggerInterface;

class JwtAuth{
    
    use \ModeloBundle\Traits\JwtTrait;
    //Manager de doctrine
    public $manager;
    //Llave para generar un token
    public $key;
    private $logger;

    public function __construct($manager, LoggerInterface $logger){
        $this->manager = $manager;
        $this->key = "C0nt4l3ntoSAS.C0m";
        $this->logger = $logger;
    }

    public function singup($params) {
        
        //Obtener el usuario con los parametros enviados
        $pwd = hash('sha256',$params->clave);
        
        $user= $this->manager->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
            "usuario" => $params->usuario,
            "clave"   => $pwd
        ));

        if(is_object($user)){
          if($user->getActivoempresa()){

            $token = $user->toArray();

            $token['sub']=$user->getPkidempresa();
            unset($token['pkidempresa']);
            unset($token['clave']);
            //Generar un token jwt
            // $token = array(
            //     'sub' => $user->getPkidempresa(),
            //     'fkiddepartamento' => $user->getFkiddepartamento(),
            //     'fkidciudad' => $user->getFkidciudad(),
            //     'usuario' => $user->getUsuario(),
            //     'telefonos' =>$user->getTelefonos(),
            //     'nit' =>$user->getNit(),
            //     'direccion' =>$user->getDireccion(),
            //     'nombreempresa' =>$user->getNombre(),
            //     'descripcion' =>$user->getDescripcion(),
            //     'activo' =>$user->getActivoempresa(),
            //     'logo' =>$user->getLogo(),
            //     'tienecupones' =>$user->getTienecupones(),
            //     'cuponespermitidos' =>$user->getCuponespermitidos(),
            //     'shakes' =>$user->getShakes(),
            //     'iat'=> time(),
            //     'exp' => time()+(7*24*60*60)//fecha de caducidad para el token, una semana                                     despues de crearse
            // );

            //Token codificado
            $jwt = JWT::encode($token,$this->key,'HS256');
            //Token decodificado
            $decode = JWT::decode($jwt,$this->key,array('HS256'));
            
            // if($getHash ==null){
            //     $data = $jwt;
            // }else{
            //     $data = $decode;              
            // }
            $data= array(
                'token'=>$jwt,
                'objeto'=>$decode
            );
        }else{            
            throw new \Exception('El usuario se encuentra desactivado. Si considera que es un error, por favor contáctenos.', 22);
        }
        }else{
            throw new \Exception('La empresa no está registrada', 22);
        }
            //Retorna token generado
        return $data;
    }


    /*checktoken anterior
    public function checkToken($jwt,$getIdentity=false){
        $auth = false;
        $decode = null;
        try{
            $decode = JWT::decode($jwt,$this->key,array('HS256'));
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }


        if(isset($decode) && is_object($decode) && isset($decode->sub)){
            $auth = true;
        }else{
            $auth = false;
        }
        if($getIdentity==false){
            return $auth;
        }else{
            
            return $decode;
        }
    }
    */
}


?>