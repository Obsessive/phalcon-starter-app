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

    /**
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pages';
    }

}