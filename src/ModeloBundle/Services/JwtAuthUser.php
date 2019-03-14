<?php
namespace ModeloBundle\Services;
use Firebase\JWT\JWT;
use Psr\Log\LoggerInterface;
class JwtAuthUser{
    
    use \ModeloBundle\Traits\JwtTrait;

    //Manager de doctrine
    public $manager;
    //Llave para generar un token
    public $key;
    private $logger;
    
    public function __construct($manager, LoggerInterface $logger){
        $this->manager = $manager;
        $this->key = "C0nt4l3ntoSAS.C0mUsers";
        $this->logger = $logger;
    }
    public function singup($params,$getHash=null){
       

        //Obtener el usuario con los parametros enviados
        $user= $this->manager->getRepository('ModeloBundle:Tusuario')->findOneBy(array('telefono' => $params->telefono, 'imei'=>$params->imei));
       
        if(is_object($user)) {
            
            if($user->getActivousuario()){
                //Generar un token jwt
                $token = $user->toArray();

                $token['sub']=$user->getPkidusuario();
                unset($token['pkidusuario']);
                // unset($token['clave']);
    
                // $token = array(
                //         "sub"=>$user->getPkidusuario(),
                //         "nombre" => $user->getNombre(),
                //         "telefono" =>$user->getTelefono(),                        
                //         "imei"=>$user->getImei(),
                //         "iat"=> time(),
                //         "exp" => time()+(7*24*60*60)//fecha de caducidad para el token, una semana                                     despues de crearse
                // );
                //Token codificado
                $jwt = JWT::encode($token,$this->key,'HS256');
                //Token decodificado
                $decode = JWT::decode($jwt,$this->key,array('HS256'));
                // if($getHash ==null){
                //     $data = $jwt;
                // }
                // else{
                //     $data = $decode;
                // }

                $data= array(
                    'token'=>$jwt,
                    'objeto'=>$decode
                );
            }else
            {            
                throw new \Exception('El usuario se encuentra desactivado. Si considera que es un error, por favor contáctenos.', 22);
            }
            }else
            {
                throw new \Exception('El teléfono no está registrado', 22);
            }
            //Retorna token generado
        return $data;
    }
    /*
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