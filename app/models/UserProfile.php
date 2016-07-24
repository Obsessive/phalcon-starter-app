<?php

namespace app\models;

use Phalcon\Mvc\Model;

class UserProfile extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $location;

    /**
     * @var string
     */
    public $about;

    /**
     * @var string
     */
    public $cover;

    /**
     * @var string
     */
    public $number;
    
    /**
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_profile';
    }

}