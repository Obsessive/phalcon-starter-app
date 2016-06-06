<?php

namespace app\models;

use Phalcon\Mvc\Model;
use app\models\UserPages;

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

    /**
     * Check if user can access given page. Return the Page model
     */
    public function checkPageAccess($pageId)
    {
        $userPage = UserPages::findFirst('page_id='.$pageId);

        if ( $userPage && ($userPage->user_id == $this->id) ) {
            return $userPage->page;
        }

        return false;
    }

}