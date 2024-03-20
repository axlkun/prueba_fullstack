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

        if ($fn) {
            
            // Ejecuta la función del endpoint
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }
}
