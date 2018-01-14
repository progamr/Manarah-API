<?php

namespace App\Models;


class UserFollower extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $id;

    /**
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $follower_id;

    /**
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $following_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFollowerId()
    {
        return $this->follower_id;
    }

    /**
     * @param mixed $follower_id
     */
    public function setFollowerId($follower_id)
    {
        $this->follower_id = $follower_id;
    }

    /**
     * @return int
     */
    public function getFollowingId(): int
    {
        return $this->following_id;
    }

    /**
     * @param int $following_id
     */
    public function setFollowingId(int $following_id)
    {
        $this->following_id = $following_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_followers';
    }

}