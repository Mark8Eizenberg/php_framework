<?php

const BASE_PATH = __DIR__."/../";

session_start();

require BASE_PATH. "Core/function.php";

spl_autoload_register(function($class){
    $class = str_replace("\\", '/', $class);
    require base_path("{$class}.php");
});

require base_path('views/bootstrap.php');

$router = new \Core\Router();

require base_path('routes.php');
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

//dd($_GET);

$router->route($uri, $method);