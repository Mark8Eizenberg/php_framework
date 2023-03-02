<?php

use \Core\App;

App::resolve(\Core\Authentication::class)->unauthorizeUser();

header('location: /login', true, 303);