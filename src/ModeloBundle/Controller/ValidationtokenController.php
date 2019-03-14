<?php

namespace ModeloBundle\Controller;

//use ModeloBundle\Services\Auditoria;

use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ValidationtokenController extends Controller
{


    /*
    Esta funcion valida el token, devuelve true si es valido, false si es invalido
    se debe enviar como parametro el token generado con el nombre authorization.
     */
    /**
     * @Route("/")
     */
    public function queryAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);


        if (!empty($request->get('authorization'))) {

            $token = $request->get('authorization', null);
            $authCheck = $jwt_auth->checkToken($token);

            $valido = false;
            if ($authCheck) {
                $identity = $jwt_auth->checkToken($token, true);
                $valido = true;
            }

            $data = array(
                'status' => true,
                'token_valido' => $valido,
            );
        } else {
            $data = array(
                'status'=>false,
                'msg' => 'Envie el token para validarlo, por favor !!',
            );
        }

        return $helpers->json($data);
    }
    public function confirmarTransaccionAction(Request $request)
    {   
        $logger = $this->get('logger');
        $data = array(
            "status" => "error",
            "msg" => "Transacción invalida"
        );
        $p_cust_id_cliente = '';
        $p_key             = '';
        $x_ref_payco      = $_REQUEST['x_ref_payco'];
        $x_transaction_id = $_REQUEST['x_transaction_id'];
        $x_amount         = $_REQUEST['x_amount'];
        $x_currency_code  = $_REQUEST['x_currency_code'];
        $x_signature      = $_REQUEST['x_signature'];
        $signature = hash('sha256', $p_cust_id_cliente . '^' . $p_key . '^' . $x_ref_payco . '^' . $x_transaction_id . '^' . $x_amount . '^' . $x_currency_code);
        $x_response     = $_REQUEST['x_response'];
        $x_motivo       = $_REQUEST['x_response_reason_text'];
        $x_id_invoice   = $_REQUEST['x_id_invoice'];
        $x_autorizacion = $_REQUEST['x_approval_code'];
        //Validamos la firma
        if ($x_signature == $signature) {
            /*Si la firma esta bien podemos verificar los estado de la transacción*/
            $x_cod_response = $_REQUEST['x_cod_response'];
            switch ((int)$x_cod_response) {
                case 1:
                    # code transacción aceptada
                    $data['msg'] = "transacción aceptada";
                    break;
                case 2:
                    # code transacción rechazada
                    $data['msg'] = "transacción rechazada";
                    break;
                case 3:
                    # code transacción pendiente
                    $data['msg'] = "transacción pendiente";
                    break;
                case 4:
                    # code transacción fallida
                    $data['msg'] = "transacción fallida";
                    break;
            }
        } else {

            die("Firma no valida");
        }
        

        $logger->info('validacion ->>>: ' . $data['msg']);
        var_dump($data);
        
    }
}
