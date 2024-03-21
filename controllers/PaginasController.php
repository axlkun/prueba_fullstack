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

        // $comments = Comment::allComments();

        // $router->render('home', [
        //     "comments" => $comments
        // ]);

        $router->render('home');
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

    public static function comment(Router $router){
        $router->render('comment');
    }

    public static function profile_update(Router $router){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_SESSION['id'];
        $userDetails = Usuario::find($id);

        $router->render('profile_update', [
                "userDetails" => $userDetails
            ]);
    }

    public static function comment_update(Router $router){
        
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if(!$id){
            $router->render('home');
        }

        $commentDetails = Comment::find($id);

        $router->render('comment_update', [
                "commentDetails" => $commentDetails
            ]);
    }

    public static function comment_create(Router $router){

        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }

        // $id = $_SESSION['id'];

        $router->render('comment_create');

    }
}