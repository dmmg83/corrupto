<?php

namespace ModeloBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuthUser;
use Symfony\Component\Validator\Constraints as Assert;

class LoginUserController extends Controller
{
    use \ModeloBundle\Traits\ControllerTrait;

    public function loginAction(Request $request)
    {
        $helpers = $this->get(Helpers::class);

        //recibir Json por Post
        $json = $request->get('json', null);
        //array para devolver por defecto
        $data = array(
            'status' => false,
            'msg' => 'Por favor, envie los parametros!'
        );
        if ($json != null) {

            //convertimos el json en un objeto de php
            $params = json_decode($json);

<<<<<<< HEAD
            //Nummero identificacion del usuario
            $telefono = (isset($params->telefono)) ? $params->telefono : null;
           
            if (strlen($telefono) > 10) {
                $data = array(
                    'status' => false,
                    'msg' => 'Número de teléfono  inválido'
                );
=======
            $campos=array('imei', 'telefono');
>>>>>>> 2f0e9573af3b1e90d703a1d1f7fc4a0b6bc44599

            $camposNull= $this->validarCampos($params, $campos);
            $data = array(
                'status' => false,
                'msg' => 'Por favor, envie los parametros!'
            );
            if(!empty($camposNull))
            {
                $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                return  $helpers->json($data);
            }

            $getHash = (isset($params->getHash)) ? $params->getHash : null;

            try {                
                //Habilitar el servicio de JWT
                $jwt_auth = $this->get(JwtAuthUser::class);

                // if ($getHash == null || $getHash == false) {
                //     //Metodo para obtener el token, retorna la informacion del usuario cifrada
                //     $singup = $jwt_auth->singup($params);
                // } else {
                //     //Metodo para obtener el token, retonra la informacion del usuario sin cifrar
                //     $singup = $jwt_auth->singup($params, true);
                // }
                
                $singup = $jwt_auth->singup($params);
                
                $data['status'] = true;
                $data['token'] = $singup['token'];
                $data['objeto']= $singup['objeto'];
                unset($data['msg']);
                

<<<<<<< HEAD
            if ($getHash == null || $getHash == false) {
                //Metodo para obtener el token, retorna la informacion del usuario cifrada
                $singup = $jwt_auth->singup($telefono);
            } else {
                //Metodo para obtener el token, retonra la informacion del usuario sin cifrar
                $singup = $jwt_auth->singup($telefono, true);
            }
            $data = isset($singup['status']) ? $singup : array(
                'status' => true,
                'token' => $singup
            );
            return  $helpers->json($data);
=======
            } catch (\Throwable $th) {
                $data['msg'] = $th->getMessage();
            }            
>>>>>>> 2f0e9573af3b1e90d703a1d1f7fc4a0b6bc44599
        }

        return $this->json($data);
    }
}

