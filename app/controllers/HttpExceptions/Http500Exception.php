<?php

namespace App\Controllers\HttpExceptions;

use App\Controllers\AbstractHttpException;

/**
 * Class Http500Exception
 *
 * Execption class for Internal Server Error (500)
 *
 * @package App\Lib\Exceptions
 */
class Http500Exception extends AbstractHttpException
{
    protected $httpCode = 500;
    protected $httpMessage = 'Internal Server Error';
}
