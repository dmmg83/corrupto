<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
use ModeloBundle\Services\JwtAuthUser;
use ModeloBundle\Entity\Tempresacupon;
use ModeloBundle\Entity\Tusuario;
Use Symfony\Component\Validator\Constraints as Assert;

class EmpresacuponController extends Controller
{
    use \ModeloBundle\Traits\ControllerTrait;
    
    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
       echo "holi";
       die();
    }

    /**
     * Metodo para crear un nuevo tipo de cupon recibe el token de la empresa 
     */
    public function newEmpresacuponAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);

        $token = $request->get('authorization');
        $auth = $jwt_auth->checkToken($token);
        if($auth->valido){
        
            //identidad de la empresa logueada
            $idenity=$auth->usuario;
            //recoger datos via post
            $json = $request->get('json',null);
            
            //array error por defecto
            $data = array(
                'status' => false,
                'msg'    => 'No se pudo crear el cupón.'
            );      
            
            if($json != null){
        
                //entiti manager
                $em = $this->getDoctrine()->getManager();
                $params = json_decode($json);
                $campos = array('fkidtipocupon','existencias','premio','condicioncupon'); // campos que deben ir obligatoriamente en el json

                 /* (funcion ubicada en el trait ControllerTrait) valida si algun campo es null o vació... 
                    En este caso todos son obligatorios, en el caso de que haya opcionales 
                    se debe pasar solo los campos obligatorios
                 */
                $camposNull= $this->validarCampos($params, $campos);
                
                if (empty($camposNull)) { //si no hay campos nulos

                    $params->fkidempresa = $idenity->sub; //tomo el id del token y lo guardo en params para que se encargue de hacer el setter del objeto empresa           
                    $tiempo = 24; // se debe traer de configuración
                    
                    $empresacupon = new Tempresacupon();
                    /*
                        autoSet asigna todos los campos en params, menos fkidtipocupon que también viene en params
                     */
                    $empresacupon->autoSet($params,$em,array('fkidtipocupon'));
                    
                    //asigno los que no vinieron en params y los que se ignoró en autoset
                    $empresacupon->setFkidtipocupon($params->fkidtipocupon);
                    $empresacupon->setSobran($params->existencias);
                    $empresacupon->setTiempo($tiempo);
                    $empresacupon->setActivocupon(true);

                    $em->persist($empresacupon);
                    $em->flush();   
                    
                    $data['status']=true;
                    $data['empresacupon']=$empresacupon;
                    $data['msg']='El cupón fue creado con éxito.';
                }
                else {
                    $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                }
            }else{
                $data['msg']='JSON Nulo';
            }
        }else{
            $data['msg']='Token no válido';
        }
        return $helpers->json($data);
    }

    /**
     * Metodo para listar los cupones de la empresa recibe el token de la empresa 
     */
    public function listEmpresacuponAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);

        $token = $request->get('authorization',null);
        if($token != null){

            $auth = $jwt_auth->checkToken($token);
            if($auth->valido)
            {
                
                $idEmpresa = $auth->usuario->sub;
                
                $em = $this->getDoctrine()->getManager();

                $dql = "SELECT c.pkidempresacupon, c.premio, c.condicioncupon, c.existencias, c.fkidtipocupon, c.sobran, c.activocupon  FROM ModeloBundle:Tempresacupon c WHERE c.fkidempresa = $idEmpresa ORDER BY c.existencias DESC";
                
                $query = $em->createQuery($dql);
                $empresacupon = $query->getResult();
        
                $data = array(
                    'status'=>true,
                    'empresacupon'=>$empresacupon
                );
        
            }else{
                $data = array(
<<<<<<< HEAD
                    'status'=>false,
=======
<<<<<<< HEAD
                    'status'=>false,
                    'msj'=>'Autorización no valida !!'
=======
                    'status'=>'error',
>>>>>>> f63f97d3eb87b48c4fef784dc5a08efae09a4bdf
                    'msg'=>'Autorización no valida !!'
>>>>>>> 2f0e9573af3b1e90d703a1d1f7fc4a0b6bc44599
                );
            }
           
        }else{
            $data = array(
<<<<<<< HEAD
                'status'=>false,
=======
<<<<<<< HEAD
                'status'=>false,
                'msj'=>'Envie autorización !!'
=======
                'status'=>'error',
>>>>>>> f63f97d3eb87b48c4fef784dc5a08efae09a4bdf
                'msg'=>'Envie autorización !!'
>>>>>>> 2f0e9573af3b1e90d703a1d1f7fc4a0b6bc44599
            );
        }
       
        return $helpers->json($data);
    }

    /**
     * Esta función edita un tipo de cupon
     * Recibe un parametro llamado json con
     * fkidtipocupon-> requerido, el id del de cupon que se va a editar
     * nombrecupon-> requerido, el nombre del cupon 
     * iconotipocupon, el icono del tipo cupon 
     * Recibe un parametro llamado authorization con el token
     * de la empresa
     */
    public function editEmpresacuponAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);

        $token = $request->get('authorization');
        $auth = $jwt_auth->checkToken($token);
        
        if($auth->valido){
        
            //identidad de la empresa logueada
            $idenity=$auth->usuario;
            //recoger datos via post
            $json = $request->get('json',null);
            
            //array error por defecto
            $data = array(
                'status' => false,
                'msg'    => 'No se pudo crear el cupón.'
            );      
            
            if($json != null){
        
                //entiti manager
                $em = $this->getDoctrine()->getManager();
                $params = json_decode($json);
                $campos = array('pkidempresacupon','fkidtipocupon','existencias','premio','condicioncupon');
                $camposNull= $this->validarCampos($params, $campos);
                
                if (empty($camposNull)) {
                    $tiempo = 24; // se debe traer de configuración
                    
                    $empresacupon = $em->getRepository('ModeloBundle:Tempresacupon')->find($params->pkidempresacupon);
                    $empresacupon->autoSet($params,$em,array('fkidtipocupon','existencias'));
                    $empresacupon->setFkidtipocupon($params->fkidtipocupon);
                    if($empresacupon->getExistencias()!=$params->existencias)
                    {
                        $empresacupon->setExistencias($params->existencias);
                        $empresacupon->setSobran($params->existencias);
                    }
                    $empresacupon->setTiempo($tiempo);
                    //$empresacupon->setActivocupon(true);
                    $em->persist($empresacupon);
                    $em->flush();   
                    $data['status']=true;
                    $data['msg']='El cupón fue creado con éxito.';
                }
                else {
                    $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                }
            }else{
                $data['msg']='JSON Nulo';
            }
        }else{
            $data['msg']='Token no válido';
        }
        return $helpers->json($data);
    }    

    /**
     * Función para eliminar un cupon
     */
    public function removeEmpresacuponAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);

        $json = $request->get('json', null);
        $token = $request->get('authorization', null);
        $auth = $jwt_auth->checkToken($token);
        $data = array(
            'status'=>false,
            'msg'=>'Envie autorización !!'
        );
        if($auth->valido){
                
            if($json != null)
            {
                $params = json_decode($json);
                $campos = array('pkidempresacupon');
                $camposNull= $this->validarCampos($params, $campos);
                if(empty($camposNull)){
                    
                    $em = $this->getDoctrine()->getManager();
                    $empresacupon = $em->getRepository('ModeloBundle:Tempresacupon')->find($pkidempresacupon);
                    
                    $em->remove($empresacupon);
                    $em->flush();
                    $data['status']=true;
                    $data['msg']='El cuppon eliminado.';
                    
                }else{
                    $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                }
            }else{
                $data['msg']='Json nulo.';
            }
        }else{
            $data['msg']='No tiene permisos para ejecutar esta acción.';
        }
        return $helpers->json($data);
    }


    public function getPremioAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuthUser::class);

        $json = $request->get('json', null);
        $token = $request->get('authorization', null);
        $auth = $jwt_auth->checkToken($token);
        $data = array(
            'status'=>false,
            'msg'=>'Envie autorización !!'
        );
        if($auth->valido){
                
            if($json != null)
            {
                $params = json_decode($json);
                $campos = array('alazar');
                $camposNull= $this->validarCampos($params, $campos);
                if(empty($camposNull)){
                    
                    $em = $this->getDoctrine()->getManager();
                    
                    $usuario = $em->getRepository('ModeloBundle:Tusuario')->find($auth->usuario->sub);
                    //var_dump($usuario->getUltimavezalazar());die;
                    if($params->alazar) //si está jugando gratis
                    {
                        $ultimavez = $usuario->getUltimavezalazar();
                        $fecha=new \Datetime('today midnight');                       
                        //echo $ultimavez->diff($fecha)->format('%d Day and %h hours');;
                        //die;
                        $qb=$em->createQueryBuilder();
                        $qb->select('u.pkidusuario')
                            ->from('ModeloBundle:Tusuario', 'u')
                            ->orderBy('RAND()');
                        $query = $qb->getQuery();
                        $variable = $query->getResult();
                        var_dump($variable);die;

                        if($ultimavez==null || $ultimavez->diff($fecha)->d>0)
                        {

                            $usuario->setUltimavezalazar($fecha);
                            $em->flush();
                        }
                        else {
                            $data['msg']='Ya jugaste gratis el día de hoy, podrás volver a hacerlo el día de mañana.';
                            
                        }
                        
                        // $intervalo = $usuario->getCreatedat()->diff($fecha);
                        
                        // echo '<p>' . $ant->format('Y-m-d H:i') . '</p>' ;
                        // echo '<p>' . $fecha->format('Y-m-d H:i') . '</p>' ;
                        // echo $intervalo->format('%d Day and %h hours');;
                        // //var_dump($intervalo);
                        // die;
                    }
                    
                }else{
                    $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                }
            }else{
                $data['msg']='Json nulo.';
            }
        }else{
            $data['msg']='No tiene permisos para ejecutar esta acción.';
        }
        return $helpers->json($data);
    }

}