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
			return $dispatcher->forward(['controller' => 'index', 'action' => 'notFound']);
		}
	}

    protected function jsonResponse($content, $code)
    {
    	if ($code == 0) {
	 		return json_encode([ 'error' => $content, 'code' => $code ]);    		
    	}
    	if ($code == 1) {
     		return json_encode([ 'success' => $content, 'code' => $code ]);
    	}

    	return json_encode($content);
 	}
}