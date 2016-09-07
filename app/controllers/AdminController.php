<?php

namespace app\controllers;

use app\models\User;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class AdminController extends Controller
{
	public function onConstruct()
	{
        $this->config = $this->di->get('config');
        $this->userService = $this->di->get('app.services.user');
		$this->userRepository = $this->di->get('app.repositories.user');
		$this->pageRepository = $this->di->get('app.repositories.page');
		$this->rehersalsRepository = $this->di->get('app.repositories.rehersals');
	}

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $action = $dispatcher->getActionName();

        if ($action != 'index' and !$this->userService->currentUserIsAdmin()) {
                return $this->response->redirect('/');
        }
    }

    public function indexAction()
    {
        if ($this->request->isPost()) {

            $username = $this->request->get('username');
            $password = $this->request->get('password');

            if ($username !== $this->config->admin->username or $password !== $this->config->admin->password) {
                return $this->response->redirect('/');
            }

            $admin = User::findFirst(1);
            $this->userService->setAdmin($admin);          
        }
    }

    public function getAllUsersAction()
    {
        $users = $this->userRepository->findAll();
        return $this->response->setJsonContent($users);
    }

    public function getAllBandsAction()
    {
        $bands = $this->pageRepository->findAll();
        return $this->response->setJsonContent($bands);
    }



}
