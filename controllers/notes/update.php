<?php

use Core\App;
use Core\Database;
use Core\Response;
use Core\Validator;

$db = App::resolve(Database::class);
$user = \Core\Authentification::getCurrentUser();

$errors = [];

$text = $_POST['body'];

if (!Validator::string($text, 1, 1000)) {
    $errors['body'] = 'A body empty or too long';
}

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$id) {
    $errors['id'] = "Id not set";
}

$note = $db->query('select * from notes where id = :id', [
    'id' => $id,
])->findOrFaild();

authorize($note['user_id'] == $user['id'], Response::NOT_FOUND);

if (!empty($errors)) {
    return view(
        'notes/edit.view.php',
        [
            'heading' => "Create new note",
            'errors' => $errors,
            'note' => $note
        ]
    );
}

$db->query(
    "update demo.notes set body = :body where id = :id",
    [
        'body' => $text,
        'id' => $id
    ]
);

$note['body'] = $text;

return view(
    'notes/show.view.php',
    [
        'heading' => "Create new note",
        'errors' => $errors,
        'note' => $note
    ]
);