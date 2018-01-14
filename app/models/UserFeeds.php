<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class UserFeeds extends Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $feeds_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $n_likes;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $n_comments;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $n_shares;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $n_views;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $created_at;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $updated_at;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getFeedsId()
    {
        return $this->feeds_id;
    }

    /**
     * @param $feeds_id
     */
    public function setFeedsId($feeds_id)
    {
        $this->feeds_id = $feeds_id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getNLikes()
    {
        return $this->n_likes;
    }

    /**
     * @param $n_likes
     */
    public function setNLikes($n_likes)
    {
        $this->n_likes = $n_likes;
    }

    /**
     * @return int
     */
    public function getNComments()
    {
        return $this->n_comments;
    }

    /**
     * @param $n_comments
     */
    public function setNComments($n_comments)
    {
        $this->n_comments = $n_comments;
    }

    /**
     * @return int
     */
    public function getNShares()
    {
        return $this->n_shares;
    }

    /**
     * @param $n_shares
     */
    public function setNShares($n_shares)
    {
        $this->n_shares = $n_shares;
    }

    /**
     * @return int
     */
    public function getNViews()
    {
        return $this->n_views;
    }

    /**
     * @param $n_views
     */
    public function setNViews($n_views)
    {
        $this->n_views = $n_views;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    
}