<?php

namespace Controllers;

require_once '../Router.php';
require_once '../models/Comment.php';

use MVC\Router;
use Model\Comment;

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
}