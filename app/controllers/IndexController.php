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

    public function previewAction()
    {
        if ($this->request->isPost()) {

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($username === 'johndoe' && $password === 'bmTest666') {
                $testUser = User::findFirst(4);
                $this->userService->setUser($testUser);

                $testToken = $this->config->facebook->test_token;
                $this->session->set('accessToken', $testToken);

                return $this->response->redirect('/dashboard');
            }

            return $this->response->redirect('/');
        }
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
