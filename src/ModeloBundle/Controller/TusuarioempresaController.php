<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use ModeloBundle\Entity\Tusuario;
use ModeloBundle\Entity\Tusuarioempresa;
use ModeloBundle\Entity\Tempresa;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuthUser;


class TusuarioempresaController extends Controller
{
    use \ModeloBundle\Traits\ControllerTrait;
  
    /*
    * Esta función agrega una empresa a favoritos del usuario
    * se debe enviar como parametro un token con el nombre authorization, tambien un
    * json que va contener el fkidempresa y el control
    */
    public function newAction(Request $request)
    {
     $helpers=$this->get(Helpers::class);
     $jwt_auth=$this->get(JwtAuthUser::class);

     $token=$request->get("authorization");

     $checkAuth=$jwt_auth->checkToken($token);
     
     $json=$request->get("json", null);
     //convertir el json a un objeto
     $params=json_decode($json);     

     $data= array(
        'status'=>false,
        'msg'=>'Empresa favorita no creada!!'
     );
     if($checkAuth->valido){
            
      
            if(!is_object($params)) 
            {
            $data['msg']='json malformado';
            return $helpers->json($data);
            }

            if($json!=null){

                $identity=$jwt_auth->checkToken($token)->usuario;  

                $em=$this->getDoctrine()->getManager();
                $params = json_decode($json);
                $campos = array('fkidempresa','control');
                
                $camposNull= $this->validarCampos($params, $campos);

                $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                    "pkidusuario"=>  $identity->sub
                ));

                if (empty($camposNull)){
                    
                    $tusuarioempresa= new Tusuarioempresa();
                    $tusuarioempresa->autoSet($params,$em);

                    if($user && is_object($user) && $identity->sub==$user->getPkidusuario() && $tusuarioempresa->getFkidempresa()
                    && is_object($tusuarioempresa->getFkidempresa())){

                        $tusuarioempresa->setFkidusuario( $user );
                        
                        $isset_tusuario_empresa= $em->getRepository('ModeloBundle:Tusuarioempresa')->findOneBy(array(
                            "fkidusuario"=>$user,
                            "fkidempresa"=>$tusuarioempresa->getFkidempresa()
                        ));
                        
                        if($isset_tusuario_empresa==null){

                            $em->persist($tusuarioempresa);
                            $em->flush();
                            $data['status']=true;
                            $data['msg']='empresa favorita creada';
                        }else{
                            $data['msg']='Empresa favorita ya existe';
                        }
                            
                    }else{
                        $data['msg']='Datos incorrectos';
                    }
                }else{
                    $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                }

            }else{
                $data['msg']='JSON Nulo';
            }
     }else{
         $data['msg']='Token no valido';
     }
     return $helpers->json($data);
    }

     /*
    * Esta función lista las empresas favoritas del usuario
    * se debe enviar como parametro un token con el nombre authorization
    */
    public function listAction(Request $request){

        $helpers=$this->get(Helpers::class);
        $jwt_auth=$this->get(JwtAuthUser::class);
   
        $token=$request->get("authorization");
   
        $checkAuth=$jwt_auth->checkToken($token);
        $data= array(
            'status'=>false,        
            'msg'=>'No hay registros para este usuario'
            );
        
        if($checkAuth->valido){
             
            $identity=$jwt_auth->checkToken($token)->usuario;  
            $em=$this->getDoctrine()->getManager();
            $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                "pkidusuario"=>  $identity->sub
            ));

            if($user && is_object($user) && $identity->sub==$user->getPkidusuario()){

                $tusuarioempresa= $em->getRepository('ModeloBundle:Tusuarioempresa')->findBy(array(
                    "fkidusuario"=>$identity->sub                    
                 ));
                 $tusuarioempresa = $em->createQueryBuilder()
                    ->select("u")
                    ->from('ModeloBundle:Tusuarioempresa','u')
                    ->join("u.fkidempresa","e")
                    ->where('u.fkidusuario = :fkidusuario')
                    ->setParameter('fkidusuario', $identity->sub)
                    ->orderBy('e.nombre','ASC')
                    ->getQuery()
                    ->getResult();           
               
                if($tusuarioempresa!=null){
                    $data['status']=true;
                    $data['msg']='lista de empresas';
                    $data['data']= $tusuarioempresa;
                }
            }
  
        }else{
            $data['msg']='Token invalido';
        }
        return $helpers->json($data);

    }
    
    /*
    *Esta funcion se encarga de eliminar una empresa de favoritos del usuario
    *como parametro se debe enviar el token con el nombre authorization y el fkidempresa 
    * el cuál es el id de la empresa que se desea eliminar de favoritos
    */
    public function removeAction(Request $request, $fkidempresa=null){

      $helpers=$this->get(Helpers::class);
      $jwt_auth=$this->get(JwtAuthUser::class);

      $token=$request->get("authorization");
      $checkAuth=$jwt_auth->checkToken($token);

      $data=array(
          "status"=>false,     
          "msg"=>"Empresa no encontrada en favoritos.",
      );

      if($checkAuth->valido){

            $identity=$jwt_auth->checkToken($token)->usuario;
            
            $em=$this->getDoctrine()->getManager();
        
            $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                "pkidusuario"=>  $identity->sub
            ));
            
            $empresa= $em->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
                "pkidempresa"=>$fkidempresa
            ));
            
        
            if($user && is_object($user) && $identity->sub==$user->getPkidusuario() && $empresa && is_object($empresa)){
            
            
                $favoritoEmpresa= $em->getRepository('ModeloBundle:Tusuarioempresa')->findOneBy(array(
                    "fkidempresa"=>$fkidempresa
                ));
            
                if($favoritoEmpresa && is_object($favoritoEmpresa) && $identity->sub==$favoritoEmpresa->getFkidusuario()->getPkidusuario()){

                    $em->remove($favoritoEmpresa);
                    $em->flush();
                    $data['status']=true;
                    $data['msg']='Empresa eliminada de favoritos';
                    
                }
                
            }
        
      }else{
          $data['msg']='Token no valido';
      }
      return $helpers->json($data);
    }

   
}