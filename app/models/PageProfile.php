<?php

namespace app\models;

use Phalcon\Mvc\Model;

class PageProfile extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $page_id;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var string
     */
    public $cover;    

    /**
     * @var integer
     */
    public $likes;

    /**
     * @var string
     */
    public $genre;    

    public function initialize()
    {
        $this->belongsTo("page_id","app\\models\\Page","id", array('alias' => 'page'));
    }

    /**
     * Returns the table name.
     *
     * @return string
     */
    public function getSource()
    {
        return 'page_profile';
    }

}