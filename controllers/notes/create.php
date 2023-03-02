<?php

use Core\Database;

view(
    'notes/create.view.php',
    [
        'heading' => "Create new note",
        'errors' => []
    ]
);