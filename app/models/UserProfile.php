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
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_profile';
    }

}