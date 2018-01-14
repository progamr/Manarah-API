<?php

namespace App\Controllers;


use App\Library\AuthenticationService;
use App\Library\RequestValidationService;
use App\Services\ServiceException;
use App\Services\UsersService;

class UsersController extends AbstractController
{
    /**
     * register a new user to manarah
     */
    public function registerAction()
    {
        try {
            // get the request headers and validate that it contains a valid token
            RequestValidationService::validateRequestHeaders($this->request->getHeaders(),['Token' => 'string']);

            $postData = $this->request->getJsonRawBody($associative = true);  //request post data

            // validate request data
            RequestValidationService::validateRequestBody($postData,
                ['first_name' => 'required', 'last_name' => 'required', 'username' => 'required|unique:users',
                'password' => 'required|length:(8,30)', 'email' => 'required|email|unique:users']
            );

            // save the new user record
            UsersService::register($postData);
        } catch (ServiceException $e) {
            // catch any possible exceptions and forward them to main exception handler
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * login a user with his email and password
     * @return array
     */
    public function loginAction()
    {
        try {
            // get the request headers and validate that it contains a valid token
            RequestValidationService::validateRequestHeaders($this->request->getHeaders(),['Token' => 'string']);

            $postData = $this->request->getJsonRawBody($associative = true);  //request post data

            // validate request data
            RequestValidationService::validateRequestBody($postData,
                ['password' => 'required', 'email' => 'required|email']
            );

            // login the user using his email and password
            return UsersService::login($postData['email'], $postData['password']);

        }  catch (ServiceException $e) {
            // catch any possible exceptions and forward them to main exception handler
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * A user Follow a user
     * @return bool
     */
    public function followAction()
    {
        try {
            // get the request headers and validate that it contains a valid token
            RequestValidationService::validateRequestHeaders($this->request->getHeaders(),['Token' => 'string']);

            // authenticate user
            AuthenticationService::authenticate($this->request->getHeader('Token'));

            $postData = $this->request->getJsonRawBody($associative = true);  //request post data

            // validate request data
            RequestValidationService::validateRequestBody($postData,
                ['follower_id' => 'required|number', 'following_id' => 'required|number']
            );

            // construct the following relation
            return UsersService::follow($postData['follower_id'], $postData['following_id']);
        }  catch (ServiceException $e) {
            // catch any possible exceptions and forward them to main exception handler
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }
}