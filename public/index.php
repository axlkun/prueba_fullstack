<?php

require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../Router.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';
require_once __DIR__ . '/../controllers/CommentController.php';
require_once __DIR__ . '/../controllers/PaginasController.php';
require_once __DIR__ . '/../controllers/LoginController.php';

use MVC\Router;
use Controllers\UsuarioController;
use Controllers\CommentController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router();

// CRUD
$router->post('/api/usuario',[UsuarioController::class, 'store']);
$router->put('/api/usuario',[UsuarioController::class, 'update']);
$router->delete('/api/usuario',[UsuarioController::class, 'destroy']);
$router->get('/api/usuario',[UsuarioController::class, 'show']);

$router->post('/api/comment',[CommentController::class, 'store']);
$router->put('/api/comment',[CommentController::class, 'update']);
$router->delete('/api/comment',[CommentController::class, 'destroy']);
$router->get('/api/comment',[CommentController::class, 'show']);
$router->get('/api/comment/all',[CommentController::class, 'index']);

// views
$router->get('/',[PaginasController::class,'login']);
$router->get('/register',[PaginasController::class,'register']);
$router->get('/home',[PaginasController::class,'home']);
$router->get('/profile',[PaginasController::class,'profile']);
$router->get('/comment/detail',[PaginasController::class,'comment']);
$router->get('/profile/update',[PaginasController::class,'profile_update']);
$router->get('/comment/update',[PaginasController::class,'comment_update']);
$router->get('/comment/create',[PaginasController::class,'comment_create']);

// auth
$router->post('/auth/login',[LoginController::class, 'login']);
$router->get('/auth/logout',[LoginController::class,'logout']);


$router->validateRoutes();