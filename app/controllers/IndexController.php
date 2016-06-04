<?php

namespace app\controllers;

use app\models\User;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $user = User::find(1)->getFirst();

        echo json_encode($user->toArray());exit;
    }

    public function notFoundAction()
    {
    	echo "Not Found";
    }
}
