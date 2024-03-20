<?php

namespace Controllers;

require_once '../Router.php';
require_once '../models/Comment.php';
require_once '../models/Usuario.php';

use MVC\Router;
use Model\Comment;
use Model\Usuario;

class PaginasController{

    public static function login(Router $router){
        
        $router->render('login');
    }

    public static function register(Router $router){

        $router->render('register');
    }

    public static function home(Router $router){

        $comments = Comment::allComments();

        $router->render('home', [
            "comments" => $comments
        ]);
    }

    public static function profile(Router $router){

        // session_start();
        // $id = $_SESSION['id'];
        // $userDetails = Usuario::find($id);

        // $router->render('profile', [
        //     "userDetails" => $userDetails
        // ]);

        $router->render('profile');
    }
}