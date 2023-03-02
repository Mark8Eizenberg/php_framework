<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$user = \Core\Authentication::getCurrentUser();

$errors = [];

$text = $_POST['body'];

if (!Validator::string($text, 1, 1000)) {
    $errors['body'] = 'A body empty or too long';
}

if (!empty($errors)) {
    return view(
        'notes/create.view.php',
        [
            'heading' => "Create new note",
            'errors' => $errors
        ]
    );
}

$db->query(
    "INSERT INTO demo.notes(body, user_id) values (:body, :userId)",
    [
        'body' => $text,
        'userId' => $user['id']
    ]
);

header('Location: /notes', true, 303);
exit();
