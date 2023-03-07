<?php

namespace Core;

class Router
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';

    protected $routes = [];

    protected function addRoute($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller)
    {
        $this->addRoute($uri, $controller, Router::GET);
    }

    public function post($uri, $controller)
    {
        $this->addRoute($uri, $controller, Router::POST);
    }

    public function put($uri, $controller)
    {
        $this->addRoute($uri, $controller, Router::PUT);
    }

    public function delete($uri, $controller)
    {
        $this->addRoute($uri, $controller, Router::DELETE);
    }

    public function patch($uri, $controller)
    {
        $this->addRoute($uri, $controller, Router::PATCH);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] == $method) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    public static function abort($code = 404)
    {
        http_response_code($code);
        $error_page = base_path("/views/{$code}.php");
        if (file_exists($error_page)) {
            require $error_page;
        } else {
            echo "Unknown error #{$code}";
        }
        die();
    }
}
