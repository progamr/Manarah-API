<?php
/**
 * Created by PhpStorm.
 * User: progamr
 * Date: 24/12/17
 * Time: 11:58 م
 */

namespace App\Models;
use Phalcon\Mvc\Model;

class FeedsLikes extends Model
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
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $feeds_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $user_id;

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

}