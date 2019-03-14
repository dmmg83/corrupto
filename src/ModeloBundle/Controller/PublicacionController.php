<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Entity\Tpublicacion;
use ModeloBundle\Entity\Tusuario;
use ModeloBundle\Services\JwtAuthUser;



class PublicacionController extends Controller 
{
    use \ModeloBundle\Traits\ControllerTrait;
    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
    }
    /*
    Método para crear una publicación,
    recobe como parámetros: 
    authorization = Token del usuario el cual crea la aplicación
    json = string del objeto json con los datos necesarios para crear una publicación 'cobrado','cancelado','postid','alazar'
    la fecha de actualizacióny creación  son tomados del sistema,
    el pkidusaurio es tomado del token decodificado    
    */

     public function newPublicacionAction(Request $request){

        $helpers = $this->get(Helpers::class);        
        $jwt_auth=$this->get(JwtAuthUser::class);
        $token = $request->get('authorization',null);
        $autCheck = $jwt_auth->checkToken($token);
        
        if($autCheck->valido){
            $json = $request->get('json',null);
           
            //array por defecto
            $data = array(
                'status'=>false,
                'msg'=>'Publicacion no registrada!!'
            );
            if($json != null){
                $fecha        = new \DateTime('now',new \DateTimeZone('America/Bogota'));
                $params=json_decode($json); 
                $em = $this->getDoctrine()->getEntityManager();
                $usuario= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                    "pkidusuario"=>$autCheck->usuario->sub
                    ));
                $campos = array('cobrado','cancelado','postid','alazar');
                $camposNull =(array) $this->validarCampos($params,$campos);
                if(empty($camposNull)){
                    $publicacion = new Tpublicacion();
                    $publicacion->autoSet($params);
                    $publicacion->setFkidusuario($usuario);
                    $publicacion->setCreatedat($fecha);
                    $publicacion->setUpdatedat($fecha);
                    $em->persist($publicacion);
                    $em->flush();
                    $data['status'] = "exito";
                    $data['msg']    = 'Publicación creada con éxito';

                }else{
                    $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',(array)$camposNull);
                }
            }else{
                $data['msg'] = "¡¡Envie los datos por POST !!";
            }
        }else{
            $data['msg'] = "Usuario no autorizado.";
        }
        return $helpers->json($data);
     }
       /*
        Método para editar una publicación,
        recobe como parámetros: 
        authorization = Token del usuario el cual crea la aplicación
        json = string del objeto json con los datos necesarios para crear una publicación 'cobrado','cancelado','postid','alazar'
        la fecha de actualización es tomada del sistema,
        el pkidusaurio es tomado del token decodificado    
        */
     public function editPublicacionAction(Request $request){

        $helpers = $this->get(Helpers::class);        
        $jwt_auth=$this->get(JwtAuthUser::class);
        $token = $request->get('authorization',null);
        $autCheck = $jwt_auth->checkToken($token);
        
        if($autCheck->valido){
            $json = $request->get('json',null);
           
            //array por defecto
            $data = array(
                'status'=>false,
                'msg'=>'Publicacion no actualizada!!'
            );
            if($json != null){
                $fecha        = new \DateTime('now',new \DateTimeZone('America/Bogota'));
                $params=json_decode($json);
                $pkidpublicacion = isset($params->pkidpublicacion)? $params->pkidpublicacion:null; 
                $em = $this->getDoctrine()->getEntityManager();
                $publicacion= $em->getRepository('ModeloBundle:Tpublicacion')->find($pkidpublicacion);               
                $usuario= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                    "pkidusuario"=>$autCheck->usuario->sub
                    ));
                if(is_object($publicacion)){
                    $campos = array('cobrado','cancelado','postid','alazar');
                    $camposNull =(array) $this->validarCampos($params,$campos);
                    if(empty($camposNull)){
                        $publicacion = new Tpublicacion();
                        $publicacion->autoSet($params);
                        $publicacion->setUpdatedat($fecha);
                        $publicacion->setFkidusuario($usuario);
                        $em->persist($publicacion);
                        $em->flush();
                        $data['status'] = "exito";
                        $data['msg']    = 'Publicación actualizada con éxito';

                    }else{
                        $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',(array)$camposNull);
                    }
                }else{
                    $data["msg"] = "La publicacion con pkid $pkidpublicacion no existe";
                }
                
            }else{
                $data['msg'] = "¡¡Envie los datos por POST !!";
            }
        }else{
            $data['msg'] = "Usuario no autorizado.";
        }
        return $helpers->json($data);
     }   
   
    
    public function listPublicacionAction(Request $request)
    {
       $helpers = $this->get(Helpers::class);     
       $em = $this->getDoctrine()->getEntityManager();
        //array por defecto
        $data = array(
            'status'=>false,
            'msg'=>'No se encontraron publicciones!!'
        );
       $jwt_authUser = $this->get(JwtAuthUser::class);
       $token = $request->get('authorization', null);
       $autCheckUser = $jwt_authUser->checkToken($token); 
       
       if($autCheckUser->valido){
           $publicacion= $em->getRepository('ModeloBundle:Tpublicacion')->findBy(array(
               "fkidusuario"=> $autCheckUser->usuario->sub
               )); 
           if(sizeof($publicacion)>0){

               $db = $em->getConnection(); 
               $query = "SELECT * FROM tpublicacion where fkidusuario=".$autCheckUser->usuario->sub." ; ";
               $stmt = $db->prepare($query);
               $params = array();
               $stmt->execute($params);
               $publicaciones = $stmt->fetchAll(); 
               $data = array(
                   'status'=>true,
                   'publicaciones'=>$publicaciones
               );
           }else{
               $data = array(
                   'status'=>false,
                   'msg'=>'No hay un publicaciones con el fkid enviado'
               ); 
           }

       }else{
           $data = array(
               'status'=>false,
               'msg'=>'Envíe el fkid de la publicacion'
           );  
       }
       
      
       return $helpers->json($data);
    }
}       
?>