<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
use ModeloBundle\Services\JwtAuthUser;
use ModeloBundle\Entity\Ttransaccion;
use ModeloBundle\Entity\Tusuario;
use ModeloBundle\Entity\Tempresa;

class TransaccionController extends Controller
{   
    use \ModeloBundle\Traits\ControllerTrait;
    public function indexAction()
    {
        // return $this->render('ModeloBundle:Default:index.html.twig');
    }

    /**
     * Función para crear una transaccion
     * Recibe los datos de un json llamado json con los datos:
     * fkidempresa fkidusuario, fecharta, transaccion id, referencai 1, 
     * referencia2, detalle
     * 
     */
    public function newTransaccionAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);

        //recoger datos via post
        $json = $request->get('json', null);

        //array error por defecto
        $data = array(
            'status'=>false,
            'msg'    => 'Transaccion no creada!!'
        );

        $jwt_auth = $this->get(JwtAuth::class);
        $jwt_authUser = $this->get(JwtAuthUser::class);

        $token = $request->get('authorization', null);
        $authCheck = $jwt_auth->checktoken($token);
        $authCheckUser = $jwt_authUser->checktoken($token);

        if ($authCheck->valido || $authCheckUser->valido) {
                if ($json != null) {

                    //entiti manager
                    $em = $this->getDoctrine()->getManager();
                    $params = json_decode($json);
                    // NombreEmpresa usuario y clave los obtiene del parametro
                    $campos = array(); 
                    $fkidempresa = (isset($authCheck->usuario->sub)) ? $authCheck->usuario->sub : null;
                    $fkidusuario = (isset($authCheckUser->usuario->sub)) ? $authCheckUser->usuario->sub : null;
                    $transaccion = new Ttransaccion();
                    $em = $this->getDoctrine()->getManager();
                    $isset_user = $em->getRepository('ModeloBundle:Tusuario')->findOneBy(array(
                        "pkidusuario" => $fkidusuario
                    ));
                    $isset_empresa = $em->getRepository('ModeloBundle:Tempresa')->findOneBy(array(
                        "pkidempresa" => $fkidempresa
                    ));
                    $transaccion->autoset($params,$em,
                    array('fkidusuario','fkidempresa','fecharta','transaccionid','$referencia1',
                    'detalle','franquicia','valor','respuesta','codrespuesta','codaprobacion','tipodoc','doc'
                    ,'nombre','apellido','telefono','direccion','razonrespuesta','fechatransac','codigoerror'
                    ,'extra1','extra2','origen','fechacreacion'));                   
                  
                    $fechaCreacion =  new \DateTime('now', new \DateTimeZone('America/Bogota'));
                  

                    if (!is_object($isset_user)) {
                        if (!is_object($isset_empresa)) {
                            $data = array(
                                'status'=>false,
                                'msg'    => 'Usuario o  empresa no existe'
                            );
                        }
                    }
                    if (is_object($isset_user) || is_object($isset_empresa)) {
                        $transaccion = new Ttransaccion();
                        $transaccion->setfkidempresa($isset_empresa);
                        $transaccion->setfkidusuario($isset_user);                 
                        $transaccion->setCreatedat($fechaCreacion);
                        $transaccion->setUpdatedat($fechaCreacion);

                        try {
                            $em->persist($transaccion);
                            $em->flush();
                            $data = array(
                                'status' => true,
                                'msg'    => 'Transacción registrada !!',
                                'empresa' => $transaccion
                            );
                        } catch (\Throwable $th) {
                            $data = array(
                                'status'=>false,
                                'msg'    => 'Error al registrar la transacción'
                            );
                        }
                    }
                } else {

                    $data = array(
                        'status'=>false,
                        'msg'    => 'El parametro json es nulo !!'
                    );
                }
            } else {

            $data = array(
                'status'=>false,
                'msg'    => 'Usuario no autorizado !!'
            );
        }

        return $helpers->json($data);
    }

    public function listTransaccionAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_authUser = $this->get(JwtAuthUser::class);
        $jwt_auth = $this->get(JwtAuth::class);

        $token = $request->get('authorization', null);
        $autCheck = $jwt_auth->checkToken($token);
        $autCheckUser = $jwt_authUser->checkToken($token);

        //array por defecto
        $data = array(
            'status'=>false,
            'msg' => 'No se encontraron transaccines !!'
        );

        if (is_object($autCheck->usuario) || is_object($autCheckUser->usuario)) {
            $user = is_object($autCheck->usuario) ? $autCheck->usuario : $autCheckUser->usuario;            
            $usuario = is_object($autCheck->usuario) ? 'fkidempresa' : 'fkidusuario';
            $em = $this->getDoctrine()->getEntityManager();
            $db = $em->getConnection();
            $query = "SELECT * FROM ttransaccion where $usuario = $user->sub; ";
            $stmt = $db->prepare($query);
            $params = array();
            $stmt->execute($params);
            $transacciones = $stmt->fetchAll();

            $data = array(
                'status' => true,
                'transacciones' => $transacciones
            );
        } else {

            $data = array(
                'status'=>false,
                'msg' => 'Usuario no autorizado'
            );
        }
        return $helpers->json($data);
    }
}
