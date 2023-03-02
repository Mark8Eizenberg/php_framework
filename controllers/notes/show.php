<?php

use Core\App;
use Core\Database;
use Core\Response;

$db = App::resolve(Database::class);
$user = \Core\Authentification::getCurrentUser();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$note = $db->query('select * from notes where id = :id', [
    'id' => $id,
])->findOrFaild();

authorize($note['user_id'] == $user['id'], Response::NOT_FOUND);

view(
    'notes/show.view.php',
    [
        'heading' => "Note",
        'note' => $note
    ]
);
