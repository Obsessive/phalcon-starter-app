<?php

namespace app\models;

use Phalcon\Mvc\Model;

class Page extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $facebook_page_id;

    /**
     * @var string
     */
    public $name;

    public function initialize()
    {
        $this->hasOne("id","app\\models\\PageProfile","page_id", array('alias' => 'profile'));
        $this->hasManyToMany("id","app\\models\\UserPages","page_id", "user_id", "app\\models\\User", "id", array('alias' => 'admins'));
    }

    /**
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pages';
    }

    public function getPageTokenByUserId($userId)
    {
        return UserPages::findFirst('user_id='.$userId)->page_access_token;
    }

}