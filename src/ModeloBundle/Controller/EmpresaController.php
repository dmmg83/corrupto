<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
use ModeloBundle\Services\JwtAuthUser;
use ModeloBundle\Entity\Tempresa;
use ModeloBundle\Entity\Tusuario;
Use Symfony\Component\Validator\Constraints as Assert;

class EmpresaController extends Controller
{
    use \ModeloBundle\Traits\ControllerTrait;

    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
    }

    /**
     * Función para registrar una empresa
     * Recibe los datos de un json llamado json con los datos:
     * nombre, el nombre de la empresa
     * correo, correo empresa
     * clave, contraseña para la empresa
     * claveconfirmada, confirmación de la clave 
     * 
     */
    public function newEmpresaAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);

        //recoger datos via post
        $json = $request->get('json',null);
        
        //array error por defecto
        $data = array(
              'status'=>false,
              'msg'    => 'Empresa no creada!!'
        );      
        
        if($json != null){

           
            //entiti manager
            $em = $this->getDoctrine()->getManager();
            $params = json_decode($json);
            
            if(is_object($params)) {

                $claveconfirmada = (isset($params->claveconfirmada)) ? $params->claveconfirmada : null;
                $clave = (isset($params->clave)) ? $params->clave : null;
                $usuario = (isset($params->usuario)) ? $params->usuario : null;
                
                $empresa = new Tempresa();
                
                $empresa->autoSet($params, //objeto json
                    array('nombre','usuario','clave','claveconfirmada'), //campos requeridos en el json
                    null, //em no se envía
                    array('clave','claveconfirmada')); //campos ignorados
                
                //valida email 
                $emailConstraint = new Assert\Email();            
                $validateEmail = $this->get("validator")->validate($usuario,$emailConstraint);
                
                
                if (count($validateEmail) > 0) {
                    $data['msg']='El correo de la empresa no es válido.';
                }
                else {
                    if($clave == $claveconfirmada)
                    {
                        $existe_empresa = $em->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
                            "usuario"=>$usuario
                        ));
                        if (is_object($existe_empresa)) {
                            $data['msg']='La empresa ya existe';
                        }
                        else {

                            $shakes = 5; // se carga desde config        
                            $cuponesPermitidos=1;

                            $empresa->setActivoempresa(true);
                            $empresa->setCuponespermitidos($cuponesPermitidos);                        
                            $empresa->setShakes($shakes);

                            $pwd = hash('sha256',$clave);
                            
                            $empresa->setClave($pwd);
                            $em->persist($empresa);
                            $em->flush();
                            
                            $data['status']=true;
                            $data['msg']='Empresa creada.';

                        }
                    }
                    else {
                        $data['msg']='Las contraseñas no coinciden.';
                    }
                }
            }
            else {
                $data['msg']='Json malformado';
            }
            
        }
        else {
            $data['msg']='Json nulo';
        }
        return $helpers->json($data);

    }

    
    /**
     * Función para modificar una empresa
     * Recibe los datos de un json llamado json con los datos:
     * fkiddepartamento, el id del departamento de la empresa
     * fkidciudad, el id de la ciudad de la empresa
     * claveanterior, la clave actual del usuario 
     * en caso de querer cambiar de clave
     * clavenueva, la clave nueva del usuario 
     * nit, el nit de la empresa
     * nombre, el nombre de la empresa
     * direccion, la dirección de la empresa
     * telefonos, los telefonos de la empresa
     * descripción, una descripción de la empresa
     * logo, el logo de la empresa
     * 
     * catsalud, recibe 1 si pertenece a esta categoria
     * catmascotas, recibe 1 si pertenece a esta categoria
     * catropa, recibe 1 si pertenece a esta categoria 
     * cattecnologia, recibe 1 si pertenece a esta categoria
     * catvehiculo, recibe 1 si pertenece a esta categoria
     * cattiendas, recibe 1 si pertenece a esta categoria
     * catrestaurantes, recibe 1 si pertenece a esta categoria
     * 
     */
    public function editEmpresaAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);

        //recoger datos via post
        $json = $request->get('json',null);
        $token = $request->get('authorization', null);

    
        //array error por defecto
        $data = array(
              'status'=>false,
              'msg'    => 'Empresa no editada !!'
        );      
        if($token != null){
          
            $auth = $jwt_auth->checkToken($token);
            if($auth->valido)
            {
    
                if($json != null){
                   
                    $params = json_decode($json);
                    
                    if(is_object($params)) {

                        $em = $this->getDoctrine()->getManager();

                        $claveanterior = (isset($params->claveanterior)) ? $params->claveanterior : null;
                        $clavenueva = (isset($params->clavenueva)) ? $params->clavenueva : null;
                        $usuario = (isset($params->usuario)) ? $params->usuario : null;
                        //Los campos que debe tener el json
                        $camposJson=array('nombre','usuario','fkiddepartamento','fkidciudad','nit','direccion','telefonos',
                        'descripcion','logo','catsalud','catmascotas','catropa','cattecnologia','catvehiculos','cattiendas','catrestaurantes'); //campos requeridos en el json
                        $empresa = $em->getRepository('ModeloBundle:Tempresa')->find($auth->usuario->sub);    

                        if (!is_object($empresa)) {
                            $data['msg']='Empresa no encontrada';
                            return $helpers->json($data);
                        }
                        else
                        {

                        $camposNull = $this->validarCampos($params, $camposJson);
                        if(empty($camposNull))
                        {
                                        
                            if($claveanterior != null && $clavenueva != null)
                            {
                                $pwd = hash('sha256',$claveanterior);

                                if($pwd == $empresa->getClave())
                                {
                                    $pwd = hash('sha256',$clavenueva);
                                    $empresa->setClave($pwd);   
                                    
                                }
                            }
                            if($params->nit != $empresa->getNit())
                            {
                                $nit = trim($params->nit);
                                if(strlen($nit)<5)
                                {
                                    $data['msg']='El nit debe tener por lo menos 5 caracteres';
                                    return $helpers->json($data);
                                }
                                else
                                    {
                                        
                                    $empresa_nit = $em->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
                                        'nit' =>$nit
                                    ));
                                     
                                        if($empresa_nit)
                                        {
                                            $data['msg']='Ya existe una empresa con este nit '.$nit;
                                            return $helpers->json($data);
                                        }
                                      
                                    }

                                } 
                                
                                 //valida email 
                                 $emailConstraint = new Assert\Email();            
                                 $validateEmail = $this->get("validator")->validate($usuario,$emailConstraint);                        
                                 
                              if($params->usuario != $empresa->getUsuario())
                              {
                                if (count($validateEmail) > 0)
                                {
                                    $data['msg']='El correo de la empresa no es válido.';
                                     return $helpers->json($data);
                                }

                                $empresa_usuario = $em->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
                                    'usuario' =>$usuario
                                ));
                                 
                                    if($empresa_usuario)
                                    {
                                        $data['msg']='Ya existe una empresa con este usuario '.$usuario;
                                        return $helpers->json($data);
                                    }
                                     
                              }
                                 else {
                                    
                                         $empresa->autoSet($params, //objeto json
                                         $em, //em no se envía
                                         array('fkiddepartamento','fkidciudad','clave','clavenueva','claveanterior')); //campos ignorados

                                         $em->persist($empresa);
                                         $em->flush();
                                             
                                         $data['status']=true;
                                         $data['msg']='Empresa editada.'; 
                                         return $helpers->json($data);
                                                                         
                                 }
                           }
                           else {
                            $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                            return $helpers->json($data);
                             }
                                    
                        }
                       
                            
                        }
                        else {
                            $data['msg']='Json mal formado';
                            return $helpers->json($data);
                        }
                    }  
                    else {
                        $data['msg']='Json nulo';
                        return $helpers->json($data);
                    }
                } 
                else {
                    $data['msg']='Token inválido';
                    return $helpers->json($data);
                }
            } 
            else {
                $data['msg']='token nulo';
                return $helpers->json($data);
            }
            return $helpers->json($data);
        }
      

    /**
     * Esta función desactiva una empresa
     * Recibe un parametro llamado authorization con el token 
     * del usuario de la empresa
     * Recibe un parametro llamado authorization con 
     * el token de la empresa a desactivar     * 
     */
    public function removeEmpresaAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);

        $token = $request->get('authorization');
        $autCheck = $jwt_auth->checkToken($token);
        //array por
        $data = array(
            'status' => false,
            'msg'    => 'empresa no eliminada!!'
        );

    
        if($autCheck){

            $identity = $jwt_auth->checkToken($token, true);
               
                $pkidempresa = (isset($identity->usuario->sub)) ? $identity->usuario->sub : null;

                if(!empty($pkidempresa)){
                    
                    $em = $this->getDoctrine()->getManager();
             
                    $empresa = $em->getRepository('ModeloBundle:Tempresa')->find($pkidempresa);

                    if($empresa){

                        //fecha y hora actuales en la zona horaria de Colombia
                       $fechaEliminacion = new \DateTime('now',new \DateTimeZone('America/Bogota'));
                        
                        $empresa->setActivoempresa(false);
                       // $empresa->setEliminadoen($fechaEliminacion);
                        $em->flush();                           
        
                            $data = array(
                                'status' => true,
                                'msg'    => 'empresa eliminada!!'
                            );
                    }else{
                        $data = array(
                            'status'=>false,
                            'msg'    => 'empresa no encontrada !!',
                        );
                    }

                }else{
                    $data = array(
                        'status'=>false,
                        'msg'    => 'el id de la empresa a eliminar es nulo !!',
                    );
                }
                
                 }

        }else{
            $data = array(
                'status'=>false,
                'msg'    => 'token no valido !!',
            );
        }
      return $helpers->json($data);
    }

    
    /**
     * Esta función lista las empresas activas
     * recibe un parametro llamado authorization con el token del usuario
     * recibe un parametro llamado json con:
     * fkidciudad-> ciudad por la que se vaa filtrar
     * cat->la categoria por la que se va a filtrar
     * 
     */
    public function listEmpresasAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth=$this->get(JwtAuthUser::class);

        $token = $request->get('authorization',null);
        
        $json = $request->get('json',null);

       $autCheck = $jwt_auth->checkToken($token);
        //array por defecto
        $data = array(
            'status'=>false,
            'msg'=>'no se encontraron empresas !!'
        );
      
        if($autCheck){
            
            if($json != null)
            {  
              
                //convierte el json a un objeto de php
                $params = json_decode($json);
                
                $fkidciudad = (isset($params->fkidciudad)) ? $params->fkidciudad : null;
                $cat = (isset($params->cat)) ? $params->cat : null;
                 
                $em = $this->getDoctrine()->getManager();
                //si no hay una categoria para filtrar filtra por ciudad 
                if($fkidciudad == null)
                {
                    $data['msg']="Envie el id de la ciudad para filtrar !!"; 
                    return $helpers->json($data);
                }
                else{

                    if($cat == null)
                    {
                        $dql = "SELECT e FROM ModeloBundle:Tempresa e WHERE e.activoempresa = 1 and  e.fkidciudad=:fkidciudad  ORDER BY e.nombreempresa";
                
                        $query = $em->createQuery($dql);
                        $query->setParameter('fkidciudad' , $fkidciudad);
                    
                        $empresas = $query->getResult();
        
                        $data['msg']=$empresas; 
                        return $helpers->json($data);
                        
                    }else{
    
                    $data = array(
                        'status'=>true,
                        'empresas'=>$empresas
                    );
                }else{

                    $dql = "SELECT e FROM ModeloBundle:Tempresa e WHERE e.activoempresa = 1 
                    and  e.fkidciudad = $fkidciudad and e.cat$cat = 1 ORDER BY e.nombre";

                    $query = $em->createQuery($dql);                  

                    $empresas = $query->getResult();
    
                    $data = array(
                        'status'=>true,
                        'empresas'=>$empresas
                    );
                }
            
               
            }else{
                $data = array(
                    'status'=>false,
                    'msg'=>'el json es nulo'
                );
            }
            
        }else{
            $data = array(
				'status'=>false,
				'msg'=>'token no valido'
			);
        }
        return $helpers->json($data);
    }

    /**
     * Esta función busta una empresa con el id 
     * Recibe un jparametro llamado json con :
     * pknombreempresa-> obligatorio, el id de la empresa a buscar
     * Recibe un parametro llamado authorization con
     * el token de usuario
     * 
     */
    public function buscarEmpresaAction(Request $request)
    {
        
        $helpers = $this->get(Helpers::class);
        $jwt_auth=$this->get(JwtAuthUser::class);

        $token = $request->get('authorization',null);
        $autCheck = $jwt_auth->checkToken($token);
      
        //array por defecto
        $data = array(
            'status'=>false,
            'msg'=>'no se encontraron empresas !!'
        );
        
        if($autCheck){
            $json = $request->get('json', null);
            if($json != null){
                $params = json_decode($json);
              
                $nombreempresa = (isset($params->pknombreempresa)) ? $params->pknombreempresa : null;
                
                if($nombreempresa != null)
                {
                    $palabras = explode(' ', $nombreempresa);
                   
                    
                    $em = $this->getDoctrine()->getManager();
                    $empresa = $em->getRepository('ModeloBundle:Tempresa')->findoOneBy(array(
                        "nombreempresa"=>$nombreempresa
                    ));
                    if($empresa){
                        $data = array(
                            'status'=>true,
                            'empresa'=>$empresa
                        );
                    }
                    $empresa = $qb->getQuery()->getResult(); //se obtiene los resultados
                   print_r($empresa);
                   die();
                   
                }else{
                    $data = array(
                        'status'=>false,
                        'msg'=>'Envie el nombre de la empresa a buscar !!'
                    );
                }

            }else{
                $data = array(
                    'status'=>false,
                    'msg'=>'Json nulo !!'
                );
            }

        }

        return $helpers->json($data);
    }

}
