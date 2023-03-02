<?php

use Core\Response;
use Core\Router;

function base_path($path)
{
    return BASE_PATH . $path;
}

/**
 * @param mixed $value any value
 * @return never
 */
function dd($value): never
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

/**
 * Check if $url is current path
 * @param string $url url for checking
 * @return bool true if url is equal to current path
 */
function urlIs(string $url): bool
{
    $_url = parse_url($_SERVER["REQUEST_URI"])['path'];
    return $_url === $url;
}

function authorize($conditional = false, $status = Response::FORBIDDEN)
{
    if (!$conditional) {
        Router::abort($status);
    }
}


function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('/views/'.$path);
}
