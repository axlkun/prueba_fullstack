<?php

namespace MVC;

class Router
{

    public $routesGET = [];
    public $routesPOST = [];
    public $routesPUT = [];
    public $routesDELETE = [];

    public function get($url, $fn)
    {
        $this->routesGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->routesPOST[$url] = $fn;
    }
    public function put($url, $fn)
    {
        $this->routesPUT[$url] = $fn;
    }
    public function delete($url, $fn)
    {
        $this->routesDELETE[$url] = $fn;
    }

    public function validateRoutes()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $auth = $_SESSION['login'] ?? null; //el valor es true si ya inicio sesion, sino es null

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/home', '/profile', '/comment/detail', '/profile/update', '/comment/update', '/comment/create'];

        $method = $_SERVER['REQUEST_METHOD'];
        $actualUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI']; //almacena la URL o endpoint ejecutado

        switch ($method) {
            case 'GET':
                $baseUrl = strtok($actualUrl, '?');
                $fn = $this->routesGET[$baseUrl] ?? null;
                break;
            case 'POST':
                $fn = $this->routesPOST[$actualUrl] ?? null;
                break;
            case 'PUT':
                $baseUrl = strtok($actualUrl, '?');
                $fn = $this->routesPUT[$baseUrl] ?? null;
                break;
            case 'DELETE':
                $baseUrl = strtok($actualUrl, '?');
                $fn = $this->routesDELETE[$baseUrl] ?? null;
                break;
            default:
                $fn = null;
                break;
        }

        //Proteger las rutas
        if (in_array($actualUrl, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        // Ejecuta la función del endpoint
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            header('Location: /');
        }
    }

    //Muestra una vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value; //convertir la llave en variable, para acceder a su contenido, $$ -> variable de variable
        }

        ob_start(); //iniciar almacenamiento en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //limpiamos memoria
        include __DIR__ . "/views/layout.php";
    }
}
