<?php

namespace Controllers;

require_once '../Router.php';
require_once '../models/Usuario.php';

use MVC\Router;
use Model\Usuario;

class LoginController{

    public static function login(Router $router){

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $auth = new Usuario($_POST); //se crea una nueva instancia del objeto Admin con los datos almacenados en la variable POST
            //debuguear($auth);
            $errores = $auth->validate();

            if(empty($errores)){
                //verificar si el usuario existe
                $resultado = $auth->exists();

                if(!$resultado){
                    $errores = Usuario::getErrors();
                }else{
                    //verificar que el password sea el del usuario
                    $autenticado = $auth->validatePass($resultado);
                    
                    if($autenticado){
                        //autenticar al usuario
                        $auth->authenticate();
                    }else{
                        //password incorrecto
                        $errores = Usuario::getErrors();
                    }
                }
                
            }

        }

        $router->render('/login',[
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router){
        // Verificar si la sesión ya está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION = []; //se reinicia la variable de sesion
        
        header('Location: /');
    }
}

?>