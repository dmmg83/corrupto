<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuthUser;
use ModeloBundle\Entity\Thistorialjugadas;

class HistorialjugadasController extends Controller
{
  use \ModeloBundle\Traits\ControllerTrait;
     /*
    * Esta función agrega  un historial de jugada 
    * se debe enviar como parametro el token con nombre authorization
    * tambien se debe enviar como parametro un json que va contener 
    * el fkidempresa, premio, condicion, tipo y fkidcupon
    * estos datos no pueden ser nulos
    */
    public function newAction(Request $request){
      
        //importamos los servicios
        $helpers= $this->get(Helpers::class);
        $jwt_auth=$this->get(JwtAuthUser::class);
        
        //token
        $token=$request->get("authorization",null);
        $authCheck= $jwt_auth->checkToken($token);

        if($authCheck->valido){
            
            $em=$this->getDoctrine()->getManager();

            $identity=$jwt_auth->checkToken($token)->usuario;

            
           $user=$em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
            "pkidusuario"=> $identity->sub     
            ));

            $json=$request->get("json", null);          
           //array de error por defecto
            $data= array(
                'status'=>false,
                'msg'=>'Historial de jugada no creada !!'
                 );
            
            $params=json_decode($json);
            if(!is_object($params)){
                
              $data['msg']='json malformado';
               return $helpers->json($data);
             }

             if($json!=null){
              
                  $campos = array('fkidempresa','premio','condicion','tipo','fkidcupon'); // campos que deben ir obligatoriamente en el json
                  $camposNull= $this->validarCampos($params, $campos);

                  if(empty($camposNull)){
                  
                      $historial_jugada= new Thistorialjugadas();
                      $historial_jugada->autoSet($params,$em,array('fkidcupon'));
                  
                      $valor_vence=$em->getRepository('ModeloBundle:Tconfiguracion')->findOneBy(array(
                      "clave"=>"VenceCupon"));
                      
                      $vence=new \Datetime('now');
                      $vence->modify($valor_vence->getValor().' hours');

                      //buscar cupon
                      $cupon=$em->getRepository('ModeloBundle:Tempresacupon')->findOneBy(array(
                        "pkidempresacupon"=>$params->fkidcupon));
                      
                        
                      if( $identity->sub==$user->getPkidusuario() && is_object($user)&& is_object($historial_jugada->getFkidempresa()) && is_object($cupon)){

                              
                          $historial_jugada->setFkidusuario($user);                  
                          $historial_jugada->setVence($vence);
                          $historial_jugada->setFkidcupon($cupon);
                              
                          $em->persist($historial_jugada);
                          $em->flush();
                              
                          $data['status']=true;
                          $data['msg']='Historial de jugada creada';

                      }
                      else {
                            $data['msg']='Dtaos incorrectos';                                        
                          }
                    }
                    else{

                      $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                    }
             }
             else {
              $data['msg']='JSON Nulo';
             }
        }
        else{

          $data['msg']='Token no válido';
        }

        return $helpers->json($data);
    
    }

    /*
    * Esta función lista el historial de jugadas de un usuario
    * se debe enviar como parametro el token con nombre authorization
    */
    public function listAction(Request $request){

      $helpers=$this->get(Helpers::class);
      $jwt_auth=$this->get(JwtAuthUser::class);

      $token=$request->get("authorization", null);
      $authCheck=$jwt_auth->checkToken($token);
       
      $data= array(
        'status'=>false,
        'msg'=>'No existen historial de jugadas !!'
         );

      if($authCheck->valido){

        $identity=$jwt_auth->checkToken($token)->usuario;

        $em=$this->getDoctrine()->getManager();

        $isset_user = $em->getRepository('ModeloBundle:Tusuario')->findBy(array(
            "pkidusuario"=> $identity->sub
         ));

         if(count($isset_user)==1){

             
            $dql = "SELECT e FROM ModeloBundle:Thistorialjugadas e WHERE e.fkidusuario = $identity->sub ORDER BY e.createdat DESC ";
            $query = $em->createQuery($dql);
            $historialjugadas= $query->getResult();
          
            if(count($historialjugadas)!=0){
               $data['status']=true;
               $data['msg']='Historial de jugadas encontradas';
               $data['data']=$historialjugadas;
            }
         }

      }
      else{

        $data['msg']='Token no válido';
      }

      return $helpers->json($data);
    }


}