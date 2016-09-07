<?php

namespace app\controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Request;
use Facebook\Facebook;

class ControllerBase extends Controller
{
	/**
	 * @var app\models\User
	 */
	protected $user;

	public function beforeExecuteRoute(Dispatcher $dispatcher)
	{
		$this->logRequest();

		$userService = $this->di->get('app.services.user');
		$session = $this->di->get('session');

		$controller = $dispatcher->getControllerClass();	
		$action = $dispatcher->getActionName();

		$this->user = $userService->getCurrentUser();

		if ($this->user && ($session->get('is_admin'))) {
			return $this->response->redirect('/admin');
		}

		if (!$this->user && $controller == AuthController::class && $action == 'callback' ) {
			return;
		}

		if (!$this->user && $controller == IndexController::class && $action == 'login') {
			return;
		}

		if (!$this->user && $controller == AdminController::class && $action == 'index') {
			return;
		}

		if (!$this->user && ($controller != IndexController::class) ) {
			return $dispatcher->forward(['controller' => 'index', 'action' => 'notFound']);
		}
	}

    protected function jsonResponse($content, $code = null)
    {
		if(! $code) {
	       	return json_encode($content);
    	}
    	if ($code == 0) {
	 		return json_encode([ 'errorMsg' => $content, 'code' => $code ]);
    	}
    	if ($code == 1) {
     		return json_encode([ 'successMsg' => $content, 'code' => $code ]);
    	}
 	}

 	public function logRequest()
 	{
 		$requestLog = $this->di->get('app.log.request');

 		$data = [
 			'URL' 			=> $this->request->getURI(),
 			'PARAMETERS' 	=> $this->request->get(),
 			'REQUEST_BODY'	=> $this->request->getJsonRawBody() 
 		];

 		$requestLog->info(PHP_EOL . '-------------------------------------'. PHP_EOL .
 						  json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL . 
 						  '-------------------------------------' . PHP_EOL);
 	}
}