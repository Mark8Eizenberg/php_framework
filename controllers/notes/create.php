<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database'], 'stoner', '1234');

view(
    'notes/create.view.php',
    [
        'heading' => "Create new note",
        'errors' => []
    ]
);