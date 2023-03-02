<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$user = \Core\Authentification::getCurrentUser();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$note = $db->query('select * from notes where id = :id', [
    'id' => $id,
])->findOrFaild();
authorize($note['user_id'] == $user['id']);

view('notes/edit.view.php',[
    'heading' => 'Edit note',
    'errors' => [],
    'note' => $note
]);