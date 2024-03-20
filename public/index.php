<?php

require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../Router.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';

use MVC\Router;
use Controllers\UsuarioController;

$router = new Router();

$router->post('/api/usuario',[UsuarioController::class, 'store']);
$router->put('/api/usuario',[UsuarioController::class, 'update']);
$router->delete('/api/usuario',[UsuarioController::class, 'destroy']);
$router->get('/api/usuario',[UsuarioController::class, 'show']);

$router->validateRoutes();