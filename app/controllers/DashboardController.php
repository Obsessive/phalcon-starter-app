<?php

namespace app\controllers;

class DashboardController extends ControllerBase
{
	public function onConstruct()
	{
		// $this->pageRepository = $this->di->get('app.repositories.page');
	}

    public function indexAction()
    {
        $this->view->user = $this->user;

        $this->view->pageCount = $this->user->pages->count();
    }

}
