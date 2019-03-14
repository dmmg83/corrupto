<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
use ModeloBundle\Services\JwtAuthUser;
use ModeloBundle\Entity\Ttipocupon;
use ModeloBundle\Entity\Tusuario;
Use Symfony\Component\Validator\Constraints as Assert;

class TipocuponController extends Controller
{
    public function indexAction()
    {
       // return $this->render('ModeloBundle:Default:index.html.twig');
       echo "holi";
       die();
    }

    /**
     * Metodo para listar los tipos de cupones 
     */
    public function lisTipocuponAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT t FROM ModeloBundle:Ttipocupon t WHERE t.activotipocupon = 1 ORDER BY t.nombretipocupon";
        $query = $em->createQuery($dql);
        $tipocupon = $query->getResult();

        $data = array(
            'status'=>true,
            'tipocupon'=>$tipocupon
        );

        return $helpers->json($data);
    }

    
}