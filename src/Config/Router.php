<?php

namespace App\Config;

use App\Config\Message\Request;

/**
 * Class Router
 */
class Router
{
    /**
     * @param string $route
     * @param callable $callback
     */
    public static function get(string $route, callable $callback): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }
        self::on($route, $callback);
    }

    /**
     * @param string $route
     * @param callable $callback
     */
    public static function post(string $route, callable $callback): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }
        self::on($route, $callback);
    }

    /**
     * @param $regex
     * @param callable $cb
     */
    public static function on($regex, callable $cb): void
    {
        $params = strtok($_SERVER["REQUEST_URI"],'?');

        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            // first value is normally the route, lets remove it
            array_shift($matches);
            // Get the matches as parameters
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $cb(new Request($params));
        }
    }
}
