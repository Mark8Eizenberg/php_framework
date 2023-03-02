<?php

use Core\Container;
use Core\Database;
use Core\App;
use Core\Authentification;

$container = new Container;

$container->bind(Database::class, function () {
    $config = require base_path('config.php');
    return new Database($config['database'], 'stoner', '1234');
});

$container->bind(Authentification::class, function(){
    return new Authentification(App::getContainer()->resolve(Database::class));
});

App::setContainer($container);

