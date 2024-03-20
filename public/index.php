<?php

require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../Router.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';
require_once __DIR__ . '/../controllers/CommentController.php';
require_once __DIR__ . '/../controllers/PaginasController.php';

use MVC\Router;
use Controllers\UsuarioController;
use Controllers\CommentController;
use Controllers\PaginasController;

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

// views
$router->get('/',[PaginasController::class,'login']);
$router->get('/register',[PaginasController::class,'register']);
$router->get('/home',[PaginasController::class,'home']);


$router->validateRoutes();