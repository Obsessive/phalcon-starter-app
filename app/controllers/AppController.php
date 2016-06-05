<?php

namespace app\controllers;

class AppController extends ControllerBase
{
	public function onConstruct()
	{

	}

    public function indexAction()
    {
        echo $this->user->name;
    }

}
