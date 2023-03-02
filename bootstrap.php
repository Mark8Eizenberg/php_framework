<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Authentification;

$container = new Container;

$container->bind(Database::class, function () {
    $config = require base_path('config.php');
    return new Database($config['database'], 'stoner', '1234');
});

$container->bind(Authentification::class, function () {
    return new Authentification(App::getContainer()->resolve(Database::class));
});

$container->bind(Monolog\Logger::class, function () {
    $log = new Monolog\Logger('my_logger');
    $log->pushHandler(new Monolog\Handler\StreamHandler(BASE_PATH."log/".date('m.d.y') . '.log', Monolog\Logger::INFO));
    return $log;
});

App::setContainer($container);
