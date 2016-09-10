<?php

namespace app\controllers;

use app\models\User;

class IndexController extends ControllerBase
{
	public function onConstruct()
	{
		$this->facebookService = $this->di->get('app.services.facebook');
        $this->userService = $this->di->get('app.services.user');
        $this->config = $this->di->get('config');
	}

    /**
     * Application landing page - redirect to dashboard if user logged in
     */
    public function indexAction()
    {
        if ($this->user) {
            return $this->response->redirect('/dashboard');
        }

    	$this->view->url = $this->facebookService->getLoginUrl();
    }

    /**
     * Logout user
     */
    public function logoutAction()
    {
    	$this->session->destroy();
    	return $this->response->redirect('/', false);
    }

    /**
     * General not found action
     */
    public function notFoundAction()
    {
    	return $this->response->redirect('/');
    }
}
