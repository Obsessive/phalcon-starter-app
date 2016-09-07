<?php

namespace app\repositories;

use app\models\User;
use app\models\UserProfile;
use Facebook\GraphNodes\GraphUser;
use Phalcon\Http\Request;

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

    public function updateUserProfile(User $user, $name, $location, $email, $number)
    {
        $userProfile = $user->profile;

        if ($location) {
            $userProfile->location = $location;
        }

        if ($email) {
            if (! UserProfile::findFirst("email='".$email."'")) {
                $userProfile->email = $email;
            }
        }

        if ($number) {
            $userProfile->number = $number;
        }

        $userProfile->save();

        if ($name) {
            $user->name = $name;
            $user->save();
        }

        return true;
    }

    public function findAll()
    {
        $users = User::find();

        $res = [];
        foreach ($users as $user) {
            $userDTO = [];
            $userDTO = $user->toArray();
            $userDTO['profile'] = $user->profile->toArray();
            $res[] = $userDTO;
        }

        return $res;
    }

}