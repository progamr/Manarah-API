<?php

namespace App\Services;

use App\Controllers\HttpExceptions\Http401Exception;
use App\Controllers\HttpExceptions\Http404Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Models\UserFollower;
use Phalcon\Security;
use Phalcon\Security\Random;
use App\Models\Users;

/**
 * Business-logic for users
 *
 * Class UsersService
 */
class UsersService extends AbstractService
{
	/** Unable to create user */
	const ERROR_UNABLE_CREATE_USER = 11001;

	/** User not found */
	const ERROR_USER_NOT_FOUND = 11002;

	/** No such user */
	const ERROR_INCORRECT_USER = 11003;

	/** Unable to update user */
	const ERROR_UNABLE_UPDATE_USER = 11004;

	/** Unable to delete user */
	const ERROR_UNABLE_DELETE_USER = 1105;

    /** Unable to create follow relation */
    const ERROR_UNABLE_CREATE_FOLLOW_RELATION = 1106;


    /**
     * create a new user record
     * @param $data
     * @return bool
     */
	public static function register($data)
    {
        $user = new Users();    // initialize the user record
        $security = new Security();
        $random = new Random();

        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setNFollowers(0);
        $user->setNFollowing(0);
        $user->setPassword($security->hash($data['password'])); // hash the user password
        $user->setToken($random->uuid());   // generate a nique access token for the user
        $user->setCreatedAt(strtotime('now'));
        $user->setUpdatedAt(0);

        if($user->save()) {
            // if user saved successfully return true
            return true;
        } else {
            // if user was not saved return 422 status code unprocessable entry
            throw new Http422Exception('Unable to create user', self::ERROR_UNABLE_CREATE_USER);
        }
    }

    public static function login($email, $password)
    {
        $user = Users::findFirst([
            'email  = :email:',
            'bind' => [
                'email' => $email
            ]
        ]);

        if($user) {
            $security = new Security();
            if($security->checkHash($password, $user->getPassword())) {
                return ['token' => $user->getToken()];
            }

        } else {
            throw new Http401Exception('Unauthorized Http Request', self::UNAUTHORIZED_HTTP_REQUEST);
        }
    }

    public static function follow($followerId, $followingId)
    {
        // find the user who will follow some other user
        $followerUser = Users::findFirst([
            'id  = :id:',
            'bind' => [
                'id' => $followerId
            ]
        ]);

        // find the user to be followed
        $followingUser = Users::findFirst([
            'id  = :id:',
            'bind' => [
                'id' => $followingId
            ]
        ]);

        // if any of the users were not found we through a 404 not found error
        if(! $followerUser || ! $followingUser) {
            throw new Http404Exception('User Not Found', ERROR_USER_NOT_FOUND);
        }

        // find the relation first to make sure no duplicates
        $followRelation = UserFollower::findFirst([
            'follower_id = :follower_id: AND following_id = :following_id:',
            'bind' => [
                'follower_id' => $followerId,
                'following_id' => $followingId
            ]
        ]);

        // if a realtion record already exists return true
        if($followRelation)
            return true;

        $userFollower = new UserFollower();             // initialize the follow relation
        $userFollower->setFollowerId($followerId);      // set follower user id
        $userFollower->setFollowingId($followingId);    // set following user id

        // save the relation record
        if($userFollower->save()) {
            $now = strtotime('now');
            // increment follower user's number of followinsg by 1
            $followerUser->setNFollowing($followerUser->getNFollowing() + 1);
            $followerUser->setUpdatedAt($now);
            // increment following user's number of followers by 1
            $followingUser->setNFollowers($followingUser->getNFollowers() + 1);
            $followingUser->setUpdatedAt($now);
            // save the both user records
            if($followerUser->save() && $followingUser->save()) {
                return true;
            } else {
                // if user records were not saved throw 422 unprocessable request
                throw new Http422Exception('Unable to create follow relation', self::ERROR_UNABLE_CREATE_FOLLOW_RELATION);
            }
        } else{
            // if follow record is not saved throw 422 unprocessable request
            throw new Http422Exception('Unable to create follow relation', self::ERROR_UNABLE_CREATE_FOLLOW_RELATION);
        }
    }

    /**
     * get a list of all users  ids that the loggend in user follows.
     * @param $userId
     * @return array|bool
     */
    public static function getFollowingById($userId)
    {
        $followingUsers = UserFollower::find([
            'follower_id = :follower_id:',
            'bind' => [
                'follower_id' => $userId
            ],
            'columns' => 'following_id'
        ]);

        if(count($followingUsers) > 0) {
            return $followingUsers->toArray();
        } else {
            return false;
        }
    }
}
