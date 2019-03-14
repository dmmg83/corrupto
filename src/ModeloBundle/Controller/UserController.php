<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use ModeloBundle\Entity\Tusuario;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuthUser;


class UserController extends Controller
{
  use \ModeloBundle\Traits\ControllerTrait;
    /*
    * Esta función agrega un nuevo usuario
    * se debe enviar como parametro un 
    * json que va contener el nombre, teléfono y edad
    */
    public function newAction(Request $request)
    {
      // convertir los datos que nos llegan a formato json
      $helpers= $this->get(Helpers::class);
      // recibir los datos por post 
      $json=$request->get("json", null);
      $jwt_auth= $this->get(JwtAuthUser::class);
      //validar datos 
      $data= array(
         'status'=>false,         
         'msg'=>'Usuario no creado !!'
      );
      
      if($json!=null)
      {
        
        $em = $this->getDoctrine()->getManager();
        //convertir el json a un objeto
        $params=json_decode($json); 

        if(!is_object($params)) 
        {
          $data['msg']='json malformado';
          return $helpers->json($data);
        }

        $campos = array('nombre','telefono','edad','imei'); // campos que deben ir obligatoriamente en el json         
        $camposNull= $this->validarCampos($params, $campos);        

        if (empty($camposNull)) 
        {          
          if($params->edad>=10 && $params->edad<=100 && strlen($params->telefono)<=10)
          {
            $user= new Tusuario();
                 
            $user->setActivousuario(false);
            $user->setVidas(1);
            $user->autoSet($params,$em);
             
            $isset_user = $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                "telefono"=> $user->getTelefono()
             ));

         
            if($isset_user==null){
              
              $em->persist($user);
              $em->flush();
             
              $data['status']=true;
              $data['msg']='Usuario fue creado con éxito.';
              $data['user']=$user;
             }
             else{ 
                                             
              $data['status']=true;
              $data['msg']='Activa tu usuario.';
              $data['user']=$user;
               
             }
          }
          else
          {
            $data['msg']='Edad o télefono no permitido.';
          }
        }
        else
        {
          $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
        }
      }
      else
      {
        $data['msg']='JSON Nulo';
      }
      
      return $helpers->json($data);

    }
    
    /*
    * Esta función edita  un nuevo usuario o lo desactiva 
    * se debe enviar como parametro un 
    * json que va contener el nombre, teléfono y edad, tambien
    * el token del usuario logueado con el nombre authorization,
    * si se desea desactivar el usuario, se envia el parametro 
    * con el nombre eliminar, la cual debe ser diferente de null
    */
    public function editAction(Request $request){

        //servicios
        $helpers= $this->get(Helpers::class);       
        $jwt_auth= $this->get(JwtAuthUser::class);
        $token =$request->get("authorization", null);
        $eliminar =$request->get("eliminar", null);
 
        //verificar si el token es valido
        $authCheck= $jwt_auth->checkToken($token);                 
        if($authCheck->valido){

           $em=$this->getDoctrine()->getManager();
           $identity=$jwt_auth->checkToken($token)->usuario;
              
           $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
               "pkidusuario"=>$identity->sub
                ));

            $json=$request->get("json", null);
            $params=json_decode($json);

            $data= array(
              'status'=>false,             
               'msg'=>'Usuario no actualizado !!'
              );       
            if(!is_object($params)) 
              {
                $data['msg']='json malformado';
                return $helpers->json($data);
              }
           if($json!=null){
                $params = json_decode($json);
                $campos = array('nombre','telefono','edad'); // campos que deben ir obligatoriamente en el json
                
                $camposNull= $this->validarCampos($params, $campos);

                if($eliminar!=null){
                        
                  $user->setActivousuario(false);
                  $em->persist($user);
                  $em->flush();
                  $data['status']=true;
                  $data['msg']='usuario desactivado';             
              
              }
              else { if(empty($camposNull)){
                      if(strlen($params->telefono)<=10 &&$params->edad>=10 && $params->edad<=100){

                          $user->autoSet($params,$em);
                          $isset_user = $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                            "telefono"=>$params->telefono             
                            ));
                                                  
                          if($isset_user==null || $identity->telefono==$user->getTelefono()){
                                    
                                    $em->persist($user);
                                    $em->flush();
                                    
                                    $data['status']=true;
                                    $data['msg']='Usuario actualizado.';

                            }
                           else{
                                    
                                    $data['status']=false;
                                    $data['msg']='Usuario no actualizado.';
                              }
                         }
                        else{
                          $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                          }
                  }
              }
            }
            else{
            $data['msg']='JSON Nulo';
             }
        }
        else
        {
          $data['msg']='Token no válido';
        }
        return $helpers->json($data);
    }


    /*
    * Esta función busca un usuario
    * se debe enviar como parametro el 
    * token del usuario logueado con el nombre authorization, tambien se envia 
    * como parametro el id del usuario a buscar 
    */
   public function userAction(Request $request, $id=null)
   {
       //servicios
       $helpers= $this->get(Helpers::class);       
       $jwt_auth= $this->get(JwtAuthUser::class);

       //consultar el token
       $token =$request->get("authorization", null);
       $authCheck= $jwt_auth->checkToken($token);

       $data= array(
        'status'=>false,             
         'msg'=>'No se encuentra usuario!!'
        );
       if($authCheck->valido){
          
        //saca valores del usuario logeado
          $identity=$jwt_auth->checkToken($token)->usuario;        
          $em=$this-> getDoctrine()->getManager();

          $user= $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
           "pkidusuario"=>  $id
           ));
     
           if($user && is_object($user) && $identity->sub==$user->getPkidusuario()){
              
            $data['status']=true;
            $data['msg']='Usuario encontrado';
            $data['data']=$user;
           }
       }
       else{
        $data['msg']='Token no válido';
       }
       return $helpers->json($data);
   }

   /*
    * Esta función activa un usuario 
    * se debe enviar como parametro un 
    * json con el telefono, nombre, edad, imei y el codigo de verificación
    */
   public function activarUsuarioAction(Request $request){

       //servicios
       $helpers= $this->get(Helpers::class);       
       $jwt_auth= $this->get(JwtAuthUser::class);

       $json =$request->get("json", null);
      
       $data= array(
        'status'=>false,
        'msg'=>'cuenta de usuario no activada!!'
        );

        $params=json_decode($json);
        if(!is_object($params)) 
        {
          $data['msg']='json malformado';
          return $helpers->json($data);
        }

        if($json!=null){
         
          $campos = array('nombre','telefono','edad','imei','codigo'); // campos que deben ir obligatoriamente en el json
          $camposNull= $this->validarCampos($params, $campos);

          if(empty($camposNull)){
           
              $em=$this->getDoctrine()->getManager();
              $isset_user = $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                  "telefono"=> $params->telefono,
              ));
         
              if($isset_user && $isset_user->getCodigo()==$params->codigo)
              {
                $isset_user->setActivousuario(true);
                $isset_user->autoSet($params,$em,array('codigo'));
                $em->persist($isset_user);
                $em->flush();
                
                $data['status']=true;
                $data['msg']='Usuario activado';
               
              }           
          }else{
            $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
          }
        }
           
         return $helpers->json($data);   
   }
}
