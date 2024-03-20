<?php

namespace Controllers;

require_once '../models/Usuario.php';
require_once '../Router.php';

use MVC\Router;
use Model\Usuario;

class UsuarioController
{
    public static function store(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $json = file_get_contents('php://input');

            // Convertir el JSON en un array asociativo
            $datosUsuario = json_decode($json, true);

            //Crear una nueva instancia con los datos del JSON
            $usuario = new Usuario($datosUsuario);

            //Validar campos
            $errores = $usuario->validate();

            if (empty($errores)) {

                $res = $usuario->store();

                if ($res) {

                    http_response_code(201);
                    echo json_encode(array(
                        'status' => '201',
                        'message' => 'User created',
                    ));
                    return;
                } else {
                    http_response_code(500);
                    echo json_encode(array(
                        'status' => '500',
                        'message' => 'Something went wrong in database',
                    ));
                    return;
                }
            }
        }

        // campos faltantes
        http_response_code(400);
        echo json_encode(array(
            'status' => '400',
            'message' => 'Some fields are missing',
            'data' => $errores
        ));
    }

    public static function update(Router $router)
    {

        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Missing user id in URL',
            ));
            return;
        }
        $usuario = Usuario::find($id);


        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

            $json = file_get_contents('php://input');

            $datosUsuario = json_decode($json, true);

            //Sincronizar objeto en memoria con lo que el usuario escribió
            $usuario->updateObject($datosUsuario);

            $errores = $usuario->validate();

            if (empty($errores)) {
                $res = $usuario->update();

                if ($res) {

                    http_response_code(201);
                    echo json_encode(array(
                        'status' => '201',
                        'message' => 'User updated',
                    ));
                    return;
                } else {
                    http_response_code(500);
                    echo json_encode(array(
                        'status' => '500',
                        'message' => 'Something went wrong in database',
                    ));
                    return;
                }
            }

            // campos faltantes
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Some fields are missing',
                'data' => $errores
            ));
        }
    }


    public static function destroy()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Missing user id in URL',
            ));
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            $usuario = Usuario::find($id);

            if ($usuario) {
                $usuario->destroy();

                http_response_code(201);
                echo json_encode(array(
                    'status' => '201',
                    'message' => 'User deleted',
                ));
                return;
            } else {
                http_response_code(500);
                echo json_encode(array(
                    'status' => '500',
                    'message' => 'Something went wrong in database',
                ));
                return;
            }
        }
    }

    public static function show(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Missing user id in URL',
            ));
            return;
        }

        $usuario = Usuario::find($id);

        if($usuario){
            http_response_code(201);
                echo json_encode(array(
                    'status' => '201',
                    'message' => 'User requested',
                    'data' => $usuario
                ));
        }else{
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'User does not exist',
            ));
            return;
        }

    }
}
