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

$this->di->setShared('url', function() {
	$url = new UrlResolver();
	$url->setBaseUri('/');
	return $url;
});


$this->di->setShared('router', function () {
    $router = require __DIR__ . '/routes.php';
    return $router;
});


$this->di->setShared('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('app\controllers');
    return $dispatcher;
});

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

$this->di->set('db', function() {
    $config = $this->di->get('config');
	return new DbAdapter(array(
		'host' => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname' => $config->database->dbname
	));
});

$this->di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

/** Logging */
$this->di->setShared('app.log.error',function(){
        $logger = new \Phalcon\Logger\Adapter\File(APP_ROOT.'/logs/'.'error_log-'.date('Y-m-d').'.log');
        return $logger;
});