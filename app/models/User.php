<?php

namespace app\models;

use Phalcon\Mvc\Model;

class User extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $facebook_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $created_at;

    public function initialize()
    {
        $this->hasOne("id","app\\models\\UserProfile","user_id", array('alias' => 'profile'));
        $this->hasManyToMany("id","app\\models\\UserPages","user_id", "page_id", "app\\models\\Page", "id", array('alias' => 'pages'));
    }

    /**
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

}