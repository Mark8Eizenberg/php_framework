<?php

//validate inputs

use Core\App;
use Core\Validator;

$errors = [];

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if(! Validator::email($email)){
    $errors['email'] = "Wrong email";
}

if(! Validator::string($password, 5, 32)){
    $errors['password'] = "Password too small or too big";
}

if(! empty($errors)){
    return view('registration/create.view.php',
    [
        'errors' => $errors
    ]);
    
}

$db = App::resolve(\Core\Database::class);

//check if user already exist
    //if yes, redirect to login
    //if no, create user

$isUser = $db->query("select * from users where email = :email", ['email' => $email])->find();

if($isUser){
    dd('user exist');
}

dd('create user');
