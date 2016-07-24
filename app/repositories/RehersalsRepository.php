<?php

namespace app\repositories;

use app\models\Rehersals;

class RehersalsRepository extends Repository
{
    protected $modelClass = Rehersals::class;

    public function check(Rehersals $rehersal)
    {
        $params = [ 
            'page_id' => $rehersal->page_id,
            'scheduled_at' => $rehersal->scheduled_at                                                
        ];

        if ( $this->findFirstBy($params) ) {
            return false;
        }
        return true;
    }
}