<?php

namespace ModeloBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use ModeloBundle\Services\Helpers;
use ModeloBundle\Services\JwtAuth;
use Symfony\Component\Validator\Constraints as Assert;

class LoginController extends Controller
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
            $campos=array('usuario','clave');
            $camposNull= $this->validarCampos($params, $campos);
            $data = array(
                'status' => false,
                'msg' => 'Por favor, envie los parametros!'
            );
            if(!empty($camposNull))
            {
                $data['msg']='Los siguientes son vacíos o null: '.\implode(', ',$camposNull);
                // $data['msg'] = 'Identificacion o contrasenia incorrecta';
                return  $helpers->json($data);
                
            }
            $getHash = (isset($params->getHash)) ? $params->getHash : null;
            
            try {                
                //Habilitar el servicio de JWT
                $jwt_auth = $this->get(JwtAuth::class);

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
            } catch (\Throwable $th) {
                $data['msg'] = $th->getMessage();
            }    
           

        }

        
        return $this->json($data);
    }

}