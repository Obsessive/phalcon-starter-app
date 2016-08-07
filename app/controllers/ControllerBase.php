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

		$controller = $dispatcher->getControllerClass();
		$action = $dispatcher->getActionName();

		$this->user = $userService->getCurrentUser();

		if ( !$this->user && $controller == AuthController::class && $action == 'callback' ) {
			return;
		}

		if (!$this->user && $controller == IndexController::class && $action == 'preview') {
			return;
		}

		if ( !$this->user && ($controller != IndexController::class) ) {
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
 			'uri' 		=> $this->request->getURI(),
 			'params' 	=> $this->request->get(),
 			'body'		=> $this->request->getJsonRawBody() 
 		];

 		$requestLog->info(json_encode($data));
 	}
}