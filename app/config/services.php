<?php

use Phalcon\Config;
use	Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use	Phalcon\Mvc\Url as UrlResolver;
use	Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use	Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use	Phalcon\Session\Adapter\Files as SessionAdapter;


$this->di->setShared('config', function () {
    return new Config(require __DIR__ . '/config.php');
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
/*$this->di->setShared('url', function() use ($config) {
	$url = new UrlResolver();
	$url->setBaseUri($config->application->baseUri);
	return $url;
});
*/

$this->di->setShared('router', function () {
    $router = require __DIR__ . '/routes.php';
    return $router;
});


$this->di->setShared('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('app\controllers');

    return $dispatcher;
});

/**
 * Setting up the view component
 */
$this->di->setShared('view', function() {

	$view = new View();
	$view->setViewsDir(APP_ROOT . '/app/views');
    $view->registerEngines([
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
        '.volt' => 'volt',
    ]);
	return $view;
});

$this->di->set('volt', function($view) {
        $config = $this->di->get('config');
        $volt= new View\Engine\Volt($view, $this->di);
        $volt->setOptions(
            [
                'autoescape'        => false,
                'compileAlways'     => true,
                'compiledPath'      => $config->volt->path,
                'compiledExtension' => $config->volt->extension,
                'compiledSeparator' => $config->volt->separator,
                'stat'              => (bool) $config->volt->stat,
            ]
        );

    return $volt;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
/*$di->set('db', function() use ($config) {
	return new DbAdapter(array(
		'host' => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname' => $config->database->dbname
	));
});
*/

/**
 * Start the session the first time some component request the session service
 */
/*$di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});
*/