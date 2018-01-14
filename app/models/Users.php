<?php

namespace App\Models;

/**
 * Class Users
 * @package App\Models
 */
class Users extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $first_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $last_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $password;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $pic;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $n_followers;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $n_following;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */

    protected $created_at;


    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $token;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
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
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPic()
    {
        return $this->pic;
    }

    /**
     * @param string $pic
     */
    public function setPic($pic)
    {
        $this->pic = $pic;
    }

    /**
     * @return int
     */
    public function getNFollowers()
    {
        return $this->n_followers;
    }

    /**
     * @param $n_followers
     */
    public function setNFollowers($n_followers)
    {
        $this->n_followers = $n_followers;
    }

    /**
     * @return int
     */
    public function getNFollowing()
    {
        return $this->n_following;
    }

    /**
     * @param $n_following
     */
    public function setNFollowing($n_following)
    {
        $this->n_following = $n_following;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return$this->token;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
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

    

	/**
	 * Returns table name mapped in the model.
	 *
	 * @return string
	 */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Users[]|Users
     */
	public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

	/**
	 * Allows to query the first record that match the specified conditions
	 *
	 * @param mixed $parameters
	 * @return Users
	 */
	public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

/*

//Model SQL
CREATE TABLE users (
    id NOT NULL AUTO_INCREMENT,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(300) NOT NULL,
    pic varchar(300),
    n_followers NOT NULL,
    n_following NOT NULL,
    created_at int,
    updated_at int,
    PRIMARY KEY (id)
);
 */