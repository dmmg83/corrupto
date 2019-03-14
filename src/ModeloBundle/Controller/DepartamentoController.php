<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Entity\Tdepartamento;


class DepartamentoController extends Controller 
{
    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
    }

     public function listDepartamentoAction(Request $request)
     {
         $helpers = $this->get(Helpers::class);     

         //array por defecto
         $data = array(
             'status'=>false,
             'msg'=>'No se encontraron Departamentos!!'
         );
        
             $em = $this->getDoctrine()->getEntityManager();
             $db = $em->getConnection(); 
             $query = "SELECT * FROM tdepartamento; ";
             $stmt = $db->prepare($query);
             $params = array();
             $stmt->execute($params);
             $departamentos=$stmt->fetchAll(); 


             $data = array(
	 			'status'=>true,
	 			'departamentos'=>$departamentos
	 		);
         
         return $helpers->json($data);
     }
}       
?>