<?php

namespace App\Controllers;
use App\Controllers\HttpExceptions\Http401Exception;

/**
 * Class AbstractController
 *
 * @property \Phalcon\Http\Request              $request
 * @property \Phalcon\Http\Response             $htmlResponse
 * @property \Phalcon\Db\Adapter\Pdo\Postgresql $db
 * @property \Phalcon\Config                    $config
 * @property \App\Services\UsersService         $usersService
 * @property \App\Models\Users                  $user
 */
abstract class AbstractController extends \Phalcon\DI\Injectable
{
    /**
     * Route not found. HTTP 404 Error
     */
    const ERROR_NOT_FOUND = 1;

    /**
     * Invalid Request. HTTP 400 Error.
     */
    const ERROR_INVALID_REQUEST = 2;

    public function handleException($exceptionCode)
    {
        if($exceptionCode === 401) {
            throw new Http401Exception();
        } elseif ($exceptionCode === 404) {

        }  elseif ($exceptionCode === 400) {

        }  elseif ($exceptionCode === 429) {

        } elseif ($exceptionCode === 422) {

        }
    }

}
