<?php

namespace App\Controllers\HttpExceptions;

use App\Controllers\AbstractHttpException;

/**
 * Class Http401Exception
 *
 * Execption class for Bad Request Error (401)
 *
 * @package App\Lib\Exceptions
 */
class Http401Exception extends AbstractHttpException
{
    protected $httpCode = 401;
    protected $httpMessage = 'Unauthorized Http Request';
}
