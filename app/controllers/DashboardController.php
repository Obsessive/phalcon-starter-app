<?php

namespace app\controllers;

use app\models\Venue;
use app\models\Rehersals;

class DashboardController extends ControllerBase
{
	public function onConstruct()
	{
		$this->userRepository = $this->di->get('app.repositories.user');
		$this->pageRepository = $this->di->get('app.repositories.page');
		$this->rehersalsRepository = $this->di->get('app.repositories.rehersals');
	}

    public function indexAction()
    {
        $this->view->user = $this->user;
        $this->view->pageCount = $this->user->pages->count();
        $this->view->rehersalsCount = $this->rehersalsRepository->rehersalCountForUser($this->user);

        $venues = Venue::find();
        $this->view->venuesCount = $venues->count();
    }

    /**
     * Update user profile
     * Used in AJAX request
     */
    public function updateUserAction()
    {
        if ($this->request->isPost()) {
            
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);

            $result = $this->userRepository
            			   ->updateUserProfile($this->user, 
            			   					   $request->name, 
            			   					   $request->location, 
            			   					   $request->email, 
            			   					   $request->number);

            if ($result) {
            	return;	
            }

        	echo $this->jsonResponse('Whoops...error occured while saving profile data', 0);
        }
    }

    /**
     * Get rehersal events for angular calendar in dashboard
     * Used in AJAX request
     */
    public function rehersalsForCalendarAction()
    {
    	$rehersals = Rehersals::find();

    	$events = [];
    	foreach ($rehersals as $rehersal) {
    		$tmp = [
    			'id' => $rehersal->id,
    			'title' => '',
    			'date' => $rehersal->scheduled_at
    		];

    		$events[] = $tmp;
    	}

    	return $this->response->setJsonContent($events);
    }

}
