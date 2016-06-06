<?php

namespace app\services;

use app\models\User;
use Phalcon\Session\Adapter as Session;

class UserService
{
    /**
     * @var Phalcon\Session\Adapter
     */
    protected $session;

	public function __construct( Session $session )
	{
		$this->session = $session;
	}

	/**
	 * Get logged in user
	 */
	public function getCurrentUser()
	{
		$userId = $this->session->get('userId');
		if ($userId)
			return User::findFirst($userId);

		return null;
	}

	/**
	 * Log in user into application (save id to session)
	 */
	public function setUser(User $user)
	{
		$this->session->set('userId', $user->id);
	}

}