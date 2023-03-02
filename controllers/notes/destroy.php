<?php

use Core\Database;
use Core\Response;
use Core\Router;
use Core\App;

const USER_ID = 1;

$db = App::resolve(Database::class);


$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    Router::abort();
}

$note = $db->query('select * from notes where id = :id', [
    'id' => $id,
])->findOrFaild();

authorize($note['user_id'] == USER_ID, Response::NOT_FOUND);

$db->query("delete from notes where id = :id", [
    "id" => $id
])->find();

header('location: /notes', true, 303);
exit();
