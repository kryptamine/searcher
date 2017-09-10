<?php

namespace Core\Router;

/**
 * Class Request
 * @package Core\Router
 */
class Request
{
    /**
     * @param $name
     *
     * @return mixed
     */
    public static function get(string $name)
    {
        return $_GET[$name] ?? null;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public static function server(string $name)
    {
        return $_SERVER[$name] ?? null;
    }

    /**
     * @return string
     */
    public static function rawBody()
    {
        return file_get_contents('php://input');
    }

    /**
     * @return string
     */
    public static function method() : string
    {
        return strtolower(static::server('REQUEST_METHOD'));
    }
}