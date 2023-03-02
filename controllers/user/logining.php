<?php

use Core\App;
use Core\Authentification;
use Core\Validator;

$errors = [];

$email = filter_input(INPUT_POST, 'email');

if(! Validator::email($email)){
    $errors['email'] = "Wrong email input";
}

$password = filter_input(INPUT_POST, 'password');

if(! Validator::string($password, 5, 225))
{
    $errors['password'] = "Password has uncorrect format";
}

$user = App::resolve(Authentification::class)->getUser($email, $password);

if(! $user){
    $errors['global'] = "Wrong email or password";
}

if(! empty($errors)){
    App::resolve(Monolog\Logger::class)->warning("Error with email: {$email}, error: ".implode("|", $errors));
    return view('user/login.view.php', [
        'errors' => $errors
    ]);
}

App::resolve(Authentification::class)->authorizeUser($user);

$_SESSION['name'] = $user['name'];
App::resolve(Monolog\Logger::class)->info("User {$user['name']} with {$email} enter in system in: ".date("Y-m-d H:i:s"));
header('location: /', true, 303);