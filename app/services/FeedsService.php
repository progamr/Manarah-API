<?php

namespace App\Services;


use App\Models\FeedsShares;
use App\Models\UserFeeds;
use App\Models\Users;

class FeedsService extends AbstractService
{
    public static function list($userId, $offset)
    {
        // get feeds order by creation time limit to 30 per hit of the users that i follow
        // get the user ids that the user follows to get their feeds
        $folowwingUserIds = UsersService::getFollowingById($userId);

        if(count($folowwingUserIds) > 0) {
            $userFeeds = UserFeeds::find([
                'user_id IN ({userIds:array}) AND id >= :id:',
                'bind' => [
                    'userIds' => $folowwingUserIds,
                    'id' => $offset
                ],
                'order' => 'created_at',
                'limit' => 20
            ]);
            $userFeedsArr = $userFeeds->toArray();
            if(count($userFeedsArr)) {
                // find the share tree for each post and return it with the post entry
                foreach ($userFeedsArr as $userFeed) {
                    $userFeed['shares'] =  self::_getPostShare($userFeed->getUserId(), $userFeed->getPostId());
                    $userFeed['shares'] = self::_getPostShareWithNames($userFeed['shares']);
                }
            } else {
                // if the user followings has no posts yet
                // find the user content (posts)if any and return it.

            }


        } else {
            // if the user has no followings find the user content (posts)if any and return it.

            return true;
        }
    }

    /**
     * get a list of user shares of a given post
     * @param $userId
     * @param $postId
     * @param array $shares
     * @return array
     */
    private static function _getPostShare($userId, $postId, $shares = [])
    {
        $shareRecord = FeedsShares::findFirst([
            'sharer_id = :sharer_id: AND feeds_id = :feeds_id:',
            'bind' => [
                'sharer_id' => $userId,
                'post_id' => $postId,
            ]
        ]);
        if($shareRecord['sharer_id'] == 0) {
             return $shares;
        } else {
            $shares[] = ['sharer_id' =>  $shareRecord['sharer_id'],
                'owner_id' => $shareRecord['owner_id'], 'post_id' => $shareRecord['id']];
            self::_getPostShare($shareRecord['owner_id'], $postId, $shares);
        }
    }

    /**
     * get the names of the users (sharers and owners)
     * by their ids.
     * @param $shares
     * @return array
     */
    private static function _getPostShareWithNames($shares)
    {
        $sharesWithNames = [];
        foreach ($shares as $share) {
            // get the post sharer name
            $sharerName = Users::findFirst([
                'id = :sharer_id:',
                'bind' => [
                    'sharer_id' => $share['sharer_id']
                ],
                'columns' => ['first_name', 'last_name']
            ]);

            if($sharerName) {
                $sharerName = $sharerName->getFirstName() . $sharerName->getLastName();

            } else {
                $sharerName = 'Manarah User';
            }

            // get the post owner name
            $ownerName = Users::findFirst([
                'id = :ownerName:',
                'bind' => [
                    'ownerName' => $share['ownerName']
                ],
                'columns' => ['first_name', 'last_name']
            ]);

            if($ownerName) {
                $ownerName = $ownerName->getFirstName() . $ownerName->getLastName();

            } else {
                $ownerName = 'Manarah User';
            }

            $sharesWithNames[] = ['sharer' => $sharerName, 'owner' => $ownerName, 'post_id' => $share['post_id']];

        }

        return $sharesWithNames;
    }
}