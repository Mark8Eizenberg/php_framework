<?php

namespace Core\Middleware;

class Guest implements MiddlewareInterface
{

    public function handle()
    {
        if($_SESSION['user'] ?? false){
            header("location: /", true);
            exit();
        }
    }
}