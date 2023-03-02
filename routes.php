<?php
use Core\Router;

$router = new Router;

$router->get('/', '/controllers/index.php');
$router->get('/contact',"/controllers/contact.php");
$router->get('/about', '/controllers/about.php');

$router->get('/note', "/controllers/notes/show.php");
$router->delete('/note', "/controllers/notes/destroy.php");
$router->get('/note/edit', "/controllers/notes/edit.php");
$router->patch('/note', "/controllers/notes/update.php");

$router->get('/notes/create', "/controllers/notes/create.php");
$router->post('/notes/create', "/controllers/notes/store.php");
$router->get('/notes', "/controllers/notes/index.php");

$router->get('/register', "/controllers/user/create.php");
$router->post('/register', "/controllers/user/store.php");

$router->get('/login', "/controllers/user/login.php");
$router->post('/login', "/controllers/user/logining.php");

$router->get('/logout', "/controllers/user/logout.php");