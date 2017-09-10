<?php
/**
 * Created by PhpStorm.
 * User: kryptamine
 * Date: 07.09.17
 * Time: 23:01
 */

namespace Core\Router;

/**
 * Class Response
 * @package Core\Router
 */
class Response
{
    /**
     * @return array
     */
    private static function getBasicHeaders()
    {
        return [
            'Content-Type: application/json;charset=utf-8'
        ];
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public static function success(array $data = [])
    {
        foreach (static::getBasicHeaders() as $header) {
            header($header);
        }

        http_response_code(200);

        echo json_encode($data);
    }


    /**
     * @param array $data
     * @param int   $status
     */
    public static function error(array $data = [], int $status)
    {
        foreach (static::getBasicHeaders() as $header) {
            header($header);
        }

        http_response_code($status);

        echo json_encode($data);
    }

}