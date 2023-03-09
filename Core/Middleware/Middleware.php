<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        "quest" => Guest::class,
        "auth" => Auth::class
    ];

    public static function resolve($key)
    {
        if(! $key){
            return;
        }

        if(! key_exists($key, static::MAP)){
            throw new \Exception("No middleware matches for key '$key'");
        }

        $middleware = static::MAP[$key];

        (new $middleware)->handle();
    }
}