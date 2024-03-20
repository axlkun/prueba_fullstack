<?php

namespace Controllers;

require_once '../Router.php';

use MVC\Router;

class PaginasController{

    public static function login(Router $router){

        $router->render('login');
    }

    public static function register(Router $router){

        $router->render('register');
    }
}