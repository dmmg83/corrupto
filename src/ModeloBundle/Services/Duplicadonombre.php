<?php
namespace ModeloBundle\Services;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class Duplicadonombre
{

    public $manager;

    public function __construct(\ModeloBundle\Services\Auditoria $auditoria, \ModeloBundle\Services\JwtAuth $jwt_auth, \ModeloBundle\Services\Helpers $helpers, $manager)
    {
        $this->manager = $manager;

        $this->auditoria = $auditoria;

        $this->jwt_auth = $jwt_auth;

        $this->helpers = $helpers;

    }

    
    /*Esta funcion verifica si el nombre esta duplicado, genericamente*/
    public function duplicado($nombretabla,$nombrecampo,$nombreenviado,$token)
    {

            if ($token) {

                $token = $token;
                $authCheck = $this->jwt_auth->checkToken($token);

                if ($authCheck) {

                    $identity = $this->jwt_auth->checkToken($token, true);

                    $permisosSerializados = $identity->permisos;
                    $permisosDeserializados = unserialize($permisosSerializados);

                    if (in_array("PERM_USUARIOS", $permisosDeserializados)) {
                        $em = $this->manager;
                        $db = $em->getConnection();

                        $nombretabla=$nombretabla;
                        $nombrecampo=$nombrecampo;
                        $nombreenviado=trim($nombreenviado);

                                        $query_duplicated = "SELECT data_type
                                                       FROM information_schema.columns
                                                       WHERE TABLE_NAME='$nombretabla' AND COLUMN_NAME='$nombrecampo'";
                                        $stmt = $db->prepare($query_duplicated);
                                        $params = array();
                                        $stmt->execute($params);
                                        $query_duplicated_consul = $stmt->fetchAll();

                                        
                                        $nombretablauc=ucfirst($nombretabla);                
                                        
                                        if ($query_duplicated_consul) {

                                            
                                            $validationnombre = $em->createQueryBuilder()
                                            ->select("t")
                                            ->from("'"."AdministracionBundle:".$nombretablauc."'", 't')
                                            ->where("upper(t.".$nombrecampo.")"." = upper(:".$nombrecampo.")")
                                            ->setParameter($nombrecampo, $nombreenviado)
                                            ->getQuery()
                                            ->getOneOrNullResult();
                                            
                            if ($validationnombre != null) {
                                return true;
                            } else {
                                return false;
                            }

                        } else {
                            $data = array(
                                'status'=>false,
                                'msg' => 'El nombre de la tabla o campo enviado no existe !!',
                            );
                        }

                    } else {
                        $data = array(
                            'status'=>false,
                            'msg' => 'El usuario no tiene permisos !!',
                        );
                    }

                } else {
                    $data = array(
                        'status'=>false,
                        'msg' => 'Acceso no autorizado !!',
                    );
                }

            } else {
                $data = array(
                    'status'=>false,
                    'msg' => 'Envie los parametros, por favor !!',
                );
            }

            return $this->helpers->json($data);


    }

    

}
