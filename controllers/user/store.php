<?php

//validate inputs

use Core\App;
use Core\Validator;

$errors = [];

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if(! Validator::email($email))
{
    $errors['email'] = "Wrong email";
}

if(! Validator::string($password, 5, 32))
{
    $errors['password'] = "Password too small or too big";
}

if(! Validator::string($name, 1, 100))
{
    $errors['name'] = "Name too short or too big";
}

if(! empty($errors))
{
    return view('user/create.view.php',
    [
        'errors' => $errors
    ]);
    
}

//check if user already exist
    //if yes, redirect to login
    //if no, create user
$auth = App::resolve(\Core\Authentification::class);

$isUser =  $auth->getUser($email, $password);

if($isUser){
    $errors['global'] = 'User with this email exists';

    return view('user/login.view.php', [
        'errors' => $errors 
    ]);
}

$auth->addUser($name, $email, $password);

return view('user/login.view.php');
