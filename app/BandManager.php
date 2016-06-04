<?php

namespace app;

use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;

define('APP_ROOT', realpath(__DIR__ . '/..'));

class BandManager {

    /**
     * @var Phalcon\DI\FactoryDefault
     */
    private $di;

    /**
     * @var Phalcon\Mvc\Application
     */
    private $application;

    public function __construct()
    {
    	$this->di = new FactoryDefault();
    	$this->loadServices();

    	$this->application = new Application($this->di);
    }

    private function loadServices()
    {
        require APP_ROOT . '/app/config/services.php';
    }

	public function run()
	{
		try {
			
			/**
			 * Handle the request
			 */
			echo $this->application->handle()->getContent();

		} catch (Phalcon\Exception $e) {
			echo $e->getMessage();

		} catch (PDOException $e){
			echo $e->getMessage();
		}

	}

}