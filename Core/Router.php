<?php

namespace Core;

// include_once base_path("Core/function.php");

// ["path" => $uri] = parse_url($_SERVER["REQUEST_URI"]);

// $routes = require base_path('routes.php');

// function routesToController($uri, $routes)
// {
//     if (array_key_exists($uri, $routes)) {
//         require base_path($routes[$uri]);
//     } else {
//         abort(404);
//     }
// }

// routesToController($uri, $routes);

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
                //Apply the middleware
                if($route['middleware']) {
                    Middleware::resolve($route['middleware']);
                }
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
