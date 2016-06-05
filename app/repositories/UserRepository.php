<?php

namespace app\repositories;

use app\models\User;
use app\models\UserProfile;
use Facebook\GraphNodes\GraphUser;

class UserRepository extends Repository
{
    protected $modelClass = User::class;


    public function createFromUserNode(GraphUser $userNode)
    {
    	$user = new User;

    	$user->facebook_id = $userNode->getId();
    	$user->name = $userNode->getName();

    	if ($user->save()) {

    		$userProfile = new UserProfile;
    		$userProfile->user_id = $user->id;
    		$userProfile->picture = $userNode->getPicture()->getUrl();
    		$userProfile->save();

    		return $user;
    	}

    	return null;
    }

}