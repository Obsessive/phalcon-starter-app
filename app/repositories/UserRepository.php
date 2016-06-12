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

    	if ( $user->save() ) {

    		$userProfile = new UserProfile;
    		$userProfile->user_id = $user->id;
    		$userProfile->picture = $userNode->getPicture()->getUrl();
            $userProfile->first_name = $userNode->getFirstName();
            $userProfile->last_name = $userNode->getLastName();
            $userProfile->cover = $userNode->getField('cover')['source'];
            $userProfile->email = $userNode->getEmail();

            if ($userNode->getLocation()) {
                $userProfile->location = $userNode->getLocation()->getName();
            }

            if ( UserProfile::findFirst("email='".$userNode->getEmail()."'") ) {
                $userProfile->email = null;
            }

            $userProfile->save();

    		return $user;
    	}

    	return null;
    }

}