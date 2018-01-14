<?php

namespace App\Library;

use App\Controllers\HttpExceptions\Http401Exception;
use App\Models\Users;
use App\Services\AbstractService;

/**
 * manages user authentication and authorization.
 * Class AuthenticationService
 * @package App\Library
 */
class AuthenticationService extends AbstractService
{
    /**
     * authenticate user using his access token.
     * @param $token
     * @return Users
     */
    public static function authenticate($token)
    {
        // find the user by his token
        $user = Users::findFirst([
            'token  = :token:',
            'bind' => [
                'token' => $token
            ]
        ]);

        // if user was found return the user object else throw new unauthorized http request
        if ($user) {
            return $user;
        } else {
            throw new Http401Exception('Unauthorized Http Request', self::UNAUTHORIZED_HTTP_REQUEST);
        }
    }
}