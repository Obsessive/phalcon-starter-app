<?php

namespace app\controllers;

class RehersalsController extends ControllerBase
{

    public function indexAction()
    {
    	$this->view->user = $this->user;
    	$this->view->bands = $this->user->pages;
    }

}

