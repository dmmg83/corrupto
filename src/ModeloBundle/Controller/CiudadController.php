<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Entity\Tciudad;
use ModeloBundle\Entity\Tdepartamento;



class CiudadController extends Controller 
{
    
    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
    }

     public function listCiudadAction(Request $request)
     {
        $helpers = $this->get(Helpers::class);     
        $em = $this->getDoctrine()->getEntityManager();
         //array por defecto
         $data = array(
             'status'=>false,
             'msg'=>'No se encontraron Departamentos!!'
         );
        $fkiddepartamento = $request->get('fkiddepartamento',null);
        if($fkiddepartamento){
            $departamento= $em->getRepository('ModeloBundle:Tdepartamento')->findOneBy(array(
                "pkiddepartamento"=>$fkiddepartamento
                )); 
                
            if(is_object($departamento)){
                $db = $em->getConnection(); 
                $query = "SELECT * FROM tciudad where fkiddepartamento=$fkiddepartamento ; ";
                $stmt = $db->prepare($query);
                $params = array();
                $stmt->execute($params);
                $ciudades = $stmt->fetchAll(); 
                $data = array(
                    'status' => true,
                    'ciudades'=>$ciudades
                );
            }else{
                $data = array(
                    'status'=>false,
                    'msg'=>'No hay un departamento con el fkid enviado'
                ); 
            }

        }else{
            $data = array(
                'status'=>false,
                'msg'=>'Envíe el fkid del departamento'
            );  
        }
        
       
        return $helpers->json($data);
     }
}       
?>