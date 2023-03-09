<?php
use Core\Router;

$router = new Router;

$router->get('/', '/controllers/index.php')->only("auth");
$router->get('/contact',"/controllers/contact.php")->only("auth");
$router->get('/about', '/controllers/about.php')->only("auth");

$router->get('/note', "/controllers/notes/show.php")->only("auth");
$router->delete('/note', "/controllers/notes/destroy.php")->only("auth");
$router->get('/note/edit', "/controllers/notes/edit.php")->only("auth");
$router->patch('/note', "/controllers/notes/update.php")->only("auth");

$router->get('/notes/create', "/controllers/notes/create.php")->only("auth");
$router->post('/notes/create', "/controllers/notes/store.php")->only("auth");
$router->get('/notes', "/controllers/notes/index.php")->only("auth");

$router->get('/login', "/controllers/user/login.php")->only("quest");
$router->post('/login', "/controllers/user/signing.php")->only("quest");

$router->get('/logout', "/controllers/user/logout.php")->only("auth");

$router->get('/register', "/controllers/user/create.php")->only("quest");
$router->post('/register', "/controllers/user/store.php")->only("quest");