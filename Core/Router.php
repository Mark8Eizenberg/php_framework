<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';

    protected array $routes = [];

    protected function addRoute($uri, $controller, $method): Router
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller) : Router
    {
        return $this->addRoute($uri, $controller, Router::GET);
    }

    public function post($uri, $controller): Router
    {
        return $this->addRoute($uri, $controller, Router::POST);
    }

    public function put($uri, $controller): Router
    {
        return $this->addRoute($uri, $controller, Router::PUT);
    }

    public function delete($uri, $controller): Router
    {
        return $this->addRoute($uri, $controller, Router::DELETE);
    }

    public function patch($uri, $controller): Router
    {
        return $this->addRoute($uri, $controller, Router::PATCH);
    }

    public function only($key)
    {
        $lastRouteIndex = count($this->routes) - 1;
        $this->routes[$lastRouteIndex]['middleware'] = $key;
        return $this;
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
