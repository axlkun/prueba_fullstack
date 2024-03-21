<?php

namespace Controllers;

require_once '../models/Comment.php';
require_once '../Router.php';

use MVC\Router;
use Model\Comment;

class CommentController
{
    // nuevo comentario
    public static function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $json = file_get_contents('php://input');

            // Convertir el JSON en un array asociativo
            $datosComment = json_decode($json, true);

            //Crear una nueva instancia con los datos del JSON
            $Comment = new Comment($datosComment);

            //Validar campos
            $errores = $Comment->validate();

            if (empty($errores)) {

                $res = $Comment->store();

                if ($res) {

                    http_response_code(201);
                    echo json_encode(array(
                        'status' => '201',
                        'message' => 'Comment created',
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

    // actualizar comentario
    public static function update()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Missing comment id in URL',
            ));
            return;
        }
        $Comment = Comment::find($id);


        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

            $json = file_get_contents('php://input');

            $datosComment = json_decode($json, true);

            //Sincronizar objeto en memoria con los valores recibidos
            $Comment->updateObject($datosComment);

            $errores = $Comment->validate();

            if (empty($errores)) {
                $res = $Comment->update();

                if ($res) {

                    http_response_code(201);
                    echo json_encode(array(
                        'status' => '201',
                        'message' => 'comment updated',
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


    // eliminar un comentario
    public static function destroy()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Missing comment id in URL',
            ));
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            $Comment = Comment::find($id);

            if ($Comment) {
                $Comment->destroy();

                http_response_code(201);
                echo json_encode(array(
                    'status' => '201',
                    'message' => 'comment deleted',
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

    // mostrar un comentario por id
    public static function show(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Missing comment id in URL',
            ));
            return;
        }

        $Comment = Comment::find($id);

        if($Comment){
            http_response_code(201);
                echo json_encode(array(
                    'status' => '201',
                    'message' => 'Comment requested',
                    'data' => $Comment
                ));

                return;
        }else{
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Comment does not exist',
            ));
            return;
        }

    }


    // mostrar todos los comentarios
    public static function index(){
        
        $comments = Comment::allComments();

        if($comments){
            http_response_code(201);
                echo json_encode(array(
                    'status' => '201',
                    'message' => 'Comments requested',
                    'data' => $comments
                ));

                return;
        }else{
            http_response_code(400);
            echo json_encode(array(
                'status' => '400',
                'message' => 'Comment does not exist',
            ));
            return;
        }

    }
}
