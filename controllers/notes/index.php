<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$user = \Core\Authentification::getCurrentUser();

$notes = $db->query('select * from notes where user_id = :user', [
    'user' => $user['id']
])->findAll();

view(
    'notes/index.view.php',
    [
        'heading' => "Notes",
        'notes' => $notes
    ]
);

