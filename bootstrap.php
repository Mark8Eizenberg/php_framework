<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Authentication;

$container = new Container;

$container->bind(Database::class, function () {
    $config = require base_path('config.php');
    return new Database($config['database'], 'stoner', '1234');
});

$container->bind(Authentication::class, function () {
    return new Authentication(App::getContainer()->resolve(Database::class));
});

$container->bind(Monolog\Logger::class, function () {
    $log = new Monolog\Logger('my_logger');
    $log->pushHandler(new Monolog\Handler\StreamHandler(BASE_PATH."log/".date('m.d.y') . '.log', Monolog\Logger::INFO));
    return $log;
});

App::setContainer($container);
