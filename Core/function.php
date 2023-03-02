<?php

use Core\Response;
use Core\Router;

/**
 * Get full path for file
 * @param string $path path to file relative to BASE_PATH
 * @return string full path to file
 */
function base_path(string $path) : string
{
    return BASE_PATH . $path;
}

/**
 * Dump and die
 * @param mixed $value any value
 */
function dd($value): void
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

/**
 * On user unauthorized stuff
 * @param bool $conditional conditional for check is user authorized
 * @param int $status returning response code
 */
function authorize($conditional = false, $status = Response::FORBIDDEN)
{
    if (!$conditional) {
        Router::abort($status);
    }
}

/**
 * Render View by path
 * @param string $path path to view
 * @param array $attributes array with values what required for view
 */
function view(string $path, $attributes = [])
{
    extract($attributes);
    require base_path('/views/'.$path);
}
