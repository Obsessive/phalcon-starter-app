<?php

namespace app\repositories;

use app\models\UserPages;
use app\models\Page;
use Facebook\GraphNodes\GraphEdge;

class PageRepository extends Repository
{
    protected $modelClass = Page::class;

    /**
     * Check pages recieved from Facebook response and save to pages table, if doesn`t exist already
     *
     * @param GraphEdge $pagesEdge
     * @param string $userId
     * @return bool
     */
    public function updatePagesForUser(GraphEdge $pagesEdge, $userId)
    {
    	foreach ($pagesEdge as $pageNode) {

    		$fb_page_id = $pageNode->getField('id');
    		$name = $pageNode->getField('name');
    		$category = $pageNode->getField('category');
            $access_token = $pageNode->getField('access_token');

    		if ($category == 'Musician/Band') {

    			$page = $this->findFirstBy(['facebook_page_id' => $fb_page_id ]);

    			if(! $page) {
	    			$page = new Page;
	    			$page->facebook_page_id = $fb_page_id;
	    			$page->name = $name;

	    			if (! $page->save()) {
	    				return false;
	    			}
    			}
	    		
	    		if (! $this->updateUserPagesPivot($userId, $page->id, $access_token)) {
	    			return false;
	    		}
    		}
    	}

    	return true;
    }

    /**
     * Update UserPage entry if doesn`t exist in DB
     *
     * @param string $userId
     * @param string $pageId
     * @return bool
     */
    public function updateUserPagesPivot($userId, $pageId, $accessToken)
    {
    	$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();

        $userPage = $queryBuilder
                    ->addFrom('app\models\UserPages')
                    ->Where('user_id='.$userId)
                    ->AndWhere('page_id='.$pageId)
                    ->getQuery()
                    ->execute()
                    ->getFirst();

        if (! $userPage) {
        	$newUserPage = new UserPages;
        	$newUserPage->user_id = $userId;
        	$newUserPage->page_id = $pageId;
            $newUserPage->page_access_token = $accessToken;

        	if (! $newUserPage->save()) {
        		return false;
        	}
        }

        return true;
    }
}