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
    return view('user/login.view.php', [
        'errors' => $errors
    ]);
}

App::resolve(Authentification::class)->authorizeUser($user);

$_SESSION['name'] = $user['name'];

header('location: /', true, 303);