<?php

namespace Core\Exceptions;

use Exception;

/**
 * Class NotFoundException
 * @package Core\Exceptions
 */
class NotFoundException extends Exception
{
    protected $code = 404;
}