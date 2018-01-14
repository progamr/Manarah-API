<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class FeedsShares extends Model
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
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sharer_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $owner_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $post_id;

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
    public function getSharerId()
    {
        return $this->sharer_id;
    }

    /**
     * @param $sharer_id
     */
    public function setSharerId($sharer_id)
    {
        $this->sharer_id = $sharer_id;
    }

    /**
     * @return int
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param $owner_id
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    /**
     * @return int
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }
    
    
}

/***********************
 *
 // SQL of table
CREATE TABLE post_shares (
id int NOT NULL AUTO_INCREMENT,
sharer_id int NOT NULL,
owner_id int NOT NULL,
post_id int NOT NULL,
PRIMARY KEY (id)
);
 **********************/