<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

const BASE_PATH = __DIR__."/../";

session_start();

require BASE_PATH. "Core/function.php";

spl_autoload_register(function($class){
    $class = str_replace("\\", '/', $class);
    require base_path("{$class}.php");
});

require base_path("vendor/autoload.php");
require base_path("bootstrap.php");

$router = new \Core\Router();

require base_path('routes.php');
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

\Core\App::resolve(\Core\Authentication::class)->isAuthorized(function(&$uri){
    if(! in_array($uri, ['/login', '/register']))
    {
        $uri = '/login';
    }
}, [&$uri]);


$router->route($uri, $method);
