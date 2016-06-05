<?php

namespace app\controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Facebook\Facebook;

class ControllerBase extends Controller
{
	/**
	 * @var app\models\User
	 */
	protected $user;

	public function beforeExecuteRoute(Dispatcher $dispatcher)
	{
		$userService = $this->di->get('app.services.user');

		$controller = $dispatcher->getControllerClass();
		$action = $dispatcher->getActionName();

		$this->user = $userService->getCurrentUser();

		if ( !$this->user && $controller == AuthController::class && $action == 'callback' ) {
			return;
		}

		if ( !$this->user && ($controller != IndexController::class) ) {
			$this->response->redirect('/', false);
		}
	}

}