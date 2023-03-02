<?php

use Core\App;
use Core\Database;
use Core\Response;

const USER_ID = 1;

$db = App::resolve(Database::class);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$note = $db->query('select * from notes where id = :id', [
    'id' => $id,
])->findOrFaild();

authorize($note['user_id'] == USER_ID, Response::NOT_FOUND);

view(
    'notes/show.view.php',
    [
        'heading' => "Note",
        'note' => $note
    ]
);
