<?php

use Core\App;
use Core\Database;

const USER_ID = 1;

$db = App::resolve(Database::class);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$note = $db->query('select * from notes where id = :id', [
    'id' => $id,
])->findOrFaild();
authorize($note['user_id'] == USER_ID);

view('notes/edit.view.php',[
    'heading' => 'Edit note',
    'errors' => [],
    'note' => $note
]);