<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
use ModeloBundle\Services\JwtAuthUser;
use ModeloBundle\Entity\Ttransaccionerror;
use ModeloBundle\Entity\Tusuario;
use ModeloBundle\Entity\Tempresa;

class TransaccionErrorController extends Controller 
{
    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
    }

    public function newTransaccionErrorAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);

        //recoger datos via post
        $json = $request->get('json',null);
        
        //array error por defecto
        $data = array(
              'status'=>false,
              'msg'    => 'Transaccion no creada!!'
        );      
        
        $jwt_auth = $this->get(JwtAuth::class);
        $jwt_authUser = $this->get(JwtAuthUser::class);


        $token = $request->get('authorization', null);
        $authCheck = $jwt_auth->checktoken($token);
        $authCheckUser = $jwt_authUser->checktoken($token);

         if($authCheck->valido || $authCheckUser->valido)
         {
            if($json != null){

                $em = $this->getDoctrine()->getManager();
                $params = json_decode($json);
                

                $idtransaccion = (isset($params->fkidtransaccion)) ? $params->fkidtransaccion : null;
                $error = (isset($params->error)) ? $params->error : null;
                               
                $fechaCreacion =  new \DateTime('now',new \DateTimeZone('America/Bogota'));                
                if($idtransaccion !== null && $error != null){
                    $transaccion = new Ttransaccionerror();
                    $transaccion->setFkidtransaccion($idtransaccion);
                    $transaccion->seterror($error);
                    $transaccion->setCreatedat($fechaCreacion);
                        
                        try {
                            $em->persist($transaccion);
                            $em->flush();
                            $data = array(
                            'status' => true,
                            'msg'    => 'Transacción registrada !!',
                            'empresa' => $transaccion
                            ); 
                        } catch (\Throwable $th) {
                            $data = array(
                                'status'=>false,
                                'msg'    => 'Error al registrar la transacción'
                            ); 
                        }            
                }else{
                    $data = array(
                        'status'=>false,
                        'msg'    => 'Hay parámetros nulos !!'
                    );
                }
                          
            }else{

                $data = array(
                    'status'=>false,
                    'msg'    => 'El parametro json es nulo !!'
                );
            }

         }else{
            
            $data = array(
                'status'=>false,
                'msg'    => 'Usuario no autorizado !!'
            );
         }
       
        return $helpers->json($data);

    }   

    // public function listTransaccionAction(Request $request)
    // {
    //     $helpers = $this->get(Helpers::class);
    //     $jwt_authUser=$this->get(JwtAuthUser::class);
    //     $jwt_auth=$this->get(JwtAuth::class);

    //    $token = $request->get('authorization',null);
    //    $autCheck = $jwt_auth->checkToken($token,true);
    //    $autCheckUser = $jwt_authUser->checkToken($token,true);

    //     //array por defecto
    //     $data = array(
    //         'status'=>false,
    //         'msg'=>'No se encontraron empresas !!'
    //     );
        
    //     if(is_object($autCheck) || is_object($autCheckUser)){
    //         $user = is_object($autCheck) ? $autCheck: $autCheckUser;
    //         $usuario = is_object($autCheck) ? 'fkidempresa': 'fkidusuario';
    //         $em = $this->getDoctrine()->getEntityManager();
    //         $db = $em->getConnection(); 
    //         $query = "SELECT * FROM ttransaccion where $usuario = $user->sub; ";
    //         $stmt = $db->prepare($query);
    //         $params = array();
    //         $stmt->execute($params);
    //         $transacciones=$stmt->fetchAll(); 


    //         $data = array(
	// 			'status'=>true,
	// 			'transacciones'=>$transacciones
	// 		);
    //     }else{

    //         $data = array(
	// 			'status'=>false,				
	// 			'msg'=>'Usuario no autorizado'
	// 		);
    //     }
    //     return $helpers->json($data);
    // }
}
