<?php

namespace app\controllers;

class AdminController extends ControllerBase
{
	public function onConstruct()
	{
		$this->userRepository = $this->di->get('app.repositories.user');
		$this->pageRepository = $this->di->get('app.repositories.page');
		$this->rehersalsRepository = $this->di->get('app.repositories.rehersals');
	}

    public function indexAction()
    {
    	$username = $this->request->get('username');
    	$password = $this->request->get('password');

/*    	if ($username !==  or $password !== )
    		return $this->response->redirect('/');*/

    	$this->view->users = $this->userRepository->findAll();
    }


}
