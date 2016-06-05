<?php

namespace app\controllers;

use app\models\User;

class AuthController extends ControllerBase
{
	public function onConstruct()
	{
		$this->facebookService = $this->di->get('app.services.facebook');
		$this->userRepository = $this->di->get('app.repositories.user');
		$this->userService = $this->di->get('app.services.user');
	}

    public function callbackAction()
    {
    	$access_token = $this->facebookService->getAccessTokenFromCallback();

    	if(! $access_token) {
    		return $this->response->redirect('/');
    	}

    	$userNode = $this->facebookService->getUserByToken($access_token);
    	$user = $this->userRepository->findFirstBy(['facebook_id' => $userNode->getId()]);

    	if (! $user) {
    		$user = $this->userRepository->createFromUserNode($userNode);
    	}

    	$this->userService->setUser($user);

    	return $this->response->redirect('/app');
    }
    
}
