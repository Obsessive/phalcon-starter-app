<?php

namespace app\repositories;

use app\models\Rehersals;
use app\models\User;

class RehersalsRepository extends Repository
{
    protected $modelClass = Rehersals::class;

    /**
     * Check if rehersal already exists
     * Used in AJAX request
     */
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

    public function rehersalCountForUser(User $user)
    {
        $pages = $user->pages;

        $ids = [];
        foreach ($pages as $page) {
            $ids[] = $page->id;
        }

        $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();

        $rehersals = $queryBuilder
                    ->addFrom('app\models\Rehersals')
                    ->inWhere('page_id', $ids)
                    ->getQuery()
                    ->execute();

        return $rehersals->count();
    }
}