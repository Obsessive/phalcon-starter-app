<?php

namespace app\models;

use Phalcon\Mvc\Model;

class UserPages extends Model
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
     * @var integer
     */
    public $page_id;

    /**
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_pages';
    }

}