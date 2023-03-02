<?php

use \Core\App;

App::resolve(\Core\Authentification::class)->unauthorizeUser($user);

header('location: /login', true, 303);