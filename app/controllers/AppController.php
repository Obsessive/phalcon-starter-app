<?php

namespace app\controllers;

class AppController extends ControllerBase
{
	public function onConstruct()
	{
		$this->pageRepository = $this->di->get('app.repositories.page');
	}

    public function indexAction()
    {
    	// Dashboard index
    }

    public function pagesAction()
    {
    	$this->view->pages = $this->user->pages;
    }
}
