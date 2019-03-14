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


class TuusuarioempresaController extends Controller
{
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
        'code'=>400,
        'msg'=>'Usuario no autorizado !!'
     );
     if($checkAuth->valido){
  
            if($json!=null){

            $identity=$jwt_auth->checkToken($token)->usuario;  

            $fkidusuario=$identity->sub;
            $fkidempresa= (isset($params->fkidempresa)) ? $params->fkidempresa: null;
            $control= (isset($params->control)) ? $params->control: null;    

            $em=$this->getDoctrine()->getManager();

            $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                "pkidusuario"=>  $identity->sub
            ));
            
            $empresa= $em->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
                    "pkidempresa"=> $fkidempresa
                    ));

                if($user && is_object($user) && $identity->sub==$user->getPkidusuario() && $empresa && is_object($empresa)){


                    $empresa = $em->getRepository('ModeloBundle:Tempresa')->find($fkidempresa);
                    $usuario = $em->getRepository('ModeloBundle:Tusuario')->find($fkidusuario);
                     $tusuarioempresa= new Tusuarioempresa();
                     $tusuarioempresa->setFkidempresa($empresa);
                     $tusuarioempresa->setFkidusuario( $usuario );
                     $tusuarioempresa->setControl($control);
                     

                    $empresa = $em->getRepository('ModeloBundle:Tempresa')->find($fkidempresa);
                    $usuario = $em->getRepository('ModeloBundle:Tusuario')->find($fkidusuario);

                     $isset_tusuario_empresa= $em->getRepository('ModeloBundle:Tusuarioempresa')->findOneBy(array(
                        "fkidusuario"=> $usuario,
                        "fkidempresa"=> $empresa
                    ));
                    
                    if($isset_tusuario_empresa==null){

                        $em->persist($tusuarioempresa);
                        $em->flush();
                        $data= array(
                        'status'=>'exito',
                        'code'=>200,
                        'msg'=>'Empresa favorita creada!!',
                        'empresa'=>$tusuarioempresa
                         );  
                    }else{
                             $data= array(
                            'status'=>false,
                            'code'=>400,
                            'data'=>'registro ya existe'
                            );
                    }
                         
                }else{
                    $data= array(
                        'status'=>false,
                        'code'=>404,
                        'data'=>'no existe empresa o usuario'
                        );
                }

            }else{
                  $data= array(
                    'status'=>false,
                    'code'=>400,
                    'msg'=>'Envia datos via post!!'
                    );
            }
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
   
        $data= array(
            'status'=>false,
            'code'=>400,
            'msg'=>'usuario no autorizado!!'
            );
        $checkAuth=$jwt_auth->checkToken($token);
        
        if($checkAuth){
             
            $identity=$jwt_auth->checkToken($token)->usuario;  
            $em=$this->getDoctrine()->getManager();
            $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                "pkidusuario"=>  $identity->sub
            ));

            if($user && is_object($user) && $identity->sub==$user->getPkidusuario()){

              /*  $isset_favoritos= $em->getRepository('ModeloBundle:Tusuarioempresa')->findBy(array(
                    "fkidusuario"=> $identity->sub,
                    ));*/

              
                
                $isset_favoritos= $em->getRepository('ModeloBundle:Tusuarioempresa')->findBy(array(
                    "fkidusuario"=>$identity->sub                    
                 ));


                $isset_favoritos = $em->createQueryBuilder()
                    ->select("u")
                    ->from('ModeloBundle:Tusuarioempresa','u')
                    ->join("u.fkidempresa","e")
                    ->where('u.fkidusuario = :fkidusuario')
                    ->setParameter('fkidusuario', $identity->sub)
                    ->orderBy('e.nombre','ASC')
                    ->getQuery()
                    ->getResult();
            
             
               
                if($isset_favoritos!=null){

                  
                 
                    $data= array(
                    'status'=>'exito',
                    'code'=>200,
                    'msg'=>'lista de empresas favoritas!!',
                    'data'=>$isset_favoritos
                     );  
                }else{
                         $data= array(
                        'status'=>false,
                        'code'=>404,
                        'data'=>'No hay registros para este usuario'
                        );
                }
            }
  
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
          "status"=>"error",
          "code"=>400,
          "msg"=>"usuario no autorizado",
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
          
             if($favoritoEmpresa && is_object(  $favoritoEmpresa) && $identity->sub==$favoritoEmpresa->getFkidusuario()->getPkidusuario()){

                $em->remove($favoritoEmpresa);
                $em->flush();
                $data=array(
                    "status"=>"exito",
                    "code"=>200,
                    "msg"=>"Empresa eliminada de favoritos",                 
                    "data"=>$favoritoEmpresa,
                    );

             }else{

                $data=array(
                    "status"=>"error",
                    "code"=>404,
                    "msg"=>"no existe empresa en favoritos con ese id",
                    );
             }
              
        }else{

            $data=array(
                "status"=>"error",
                "code"=>404,
                "msg"=>"No existe usuario",
                );
        }
        
      }
      return $helpers->json($data);
    }

   
}