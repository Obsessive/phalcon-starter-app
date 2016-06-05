<?php

namespace app\controllers;

class IndexController extends ControllerBase
{
	public function onConstruct()
	{
		$this->facebookService = $this->di->get('app.services.facebook');
	}

    public function indexAction()
    {
    	if ($this->user) {
    		return $this->response->redirect('/app');
    	}

    	$this->view->url = $this->facebookService->getLoginUrl();
    }

    public function logoutAction()
    {
    	$this->session->destroy();
    	return $this->response->redirect('/', false);
    }

    public function notFoundAction()
    {
    	return $this->response->redirect('/');
    }
}
