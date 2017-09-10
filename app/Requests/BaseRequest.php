<?php

namespace App\Requests;

/**
 * Class BaseRequest
 */
abstract class BaseRequest
{
    abstract public static function rules();
}