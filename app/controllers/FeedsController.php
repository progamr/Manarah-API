<?php

namespace App\Controllers;
use App\Library\RequestValidationService;
use App\Library\AuthenticationService;
use App\Services\FeedsService;


class FeedsController extends AbstractController
{
    /**
     * Get a list of Feeds from the followings that the user follow.
     */
    public function listAction()
    {
        try {
            // get the request headers and validate that it contains a valid token
            // Offset should start with 1 at first feeds list API call
            RequestValidationService::validateRequestHeaders($this->request->getHeaders(),['Token' => 'string'
                , 'Ofsset' => 'integer']);

            // authenticate user
            $user  = AuthenticationService::authenticate($this->request->getHeader('Token'));

            // get feeds array from the user followings feeds and return it
            return FeedsService::list($user->getId(), $this->request->getHeader('Offset'));

        } catch (ServiceException $e) {
            // catch any possible exceptions and forward them to main exception handler
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

}