<?php
use Phalcon\Mvc\Micro\Collection;

/***********************************************
 * users endpoints
 **********************************************/
$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\App\Controllers\UsersController', true);
$usersCollection->setPrefix('/users');
$usersCollection->post('/register_app', 'registerAppAction');
$usersCollection->post('/login', 'loginAction');
$usersCollection->post('/register', 'registerAction');
$usersCollection->get('/profile', 'profileAction');
$usersCollection->post('/follow', 'followAction');
$usersCollection->post('/unfollow', 'unfollowAction');
$usersCollection->get('/logout', 'logoutAction');

$app->mount($usersCollection);

// not found URLs
$app->notFound(
  function () use ($app) {
      $exception =
        new \App\Controllers\HttpExceptions\Http404Exception(
          _('URI not found or error in request.'),
          \App\Controllers\AbstractController::ERROR_NOT_FOUND,
          new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
        );
      throw $exception;
  }
);
