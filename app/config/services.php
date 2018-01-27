<?php

use Phalcon\Config;
use	Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use	Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Http\Request;
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

    $config = $this->get('config');
    $volt= new View\Engine\Volt($view);
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
    $config = $this->get('config');
	return new DbAdapter(array(
		'host' => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname' => $config->database->dbname
	));
});

$this->di->setShared('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

/* Repositories */
$this->di->setShared('app.repositories.user', function() {
    return new app\repositories\UserRepository();
});

$this->di->setShared('app.repositories.page', function() {
    return new app\repositories\PageRepository();
});

$this->di->setShared('app.repositories.rehersals', function() {
    return new app\repositories\RehersalsRepository();
});

$this->di->setShared('app.repositories.user_stats', function() {
    return new app\repositories\UserStatsRepository();
});

/* Services */
$this->di->setShared('app.services.migration', function() {
    return new app\services\MigrationService( $this->get('db') );
});

$this->di->setShared('app.services.user', function() {
    return new app\services\UserService( $this->get('session'), $this->get('app.repositories.user_stats') );
});

$this->di->setShared('app.services.facebook', function() {
    $config = $this->get('config');
    $facebook = new Facebook\Facebook($config->facebook->toArray());
    return new app\services\FacebookService( $facebook, $this->get('config'), $this->get('app.log.error'), $this->get('app.services.user'), $this->get('session') );
});

$this->di->setShared('app.services.plivo', function () {
    $plivo = new Plivo\RestAPI( $this->get('config')->plivo->auth_id, $this->get('config')->plivo->auth_token );
    return new \app\services\PlivoService( $plivo, $this->get('app.repositories.page'), $this->get('app.services.user'), $this->get('app.log.plivo') );
});


/* Logging */
$this->di->setShared('app.log.error', function() {
    $logger = new \Phalcon\Logger\Adapter\File(APP_ROOT.'/logs/'.'error_log-'.date('Y-m-d').'.log');
    return $logger;
});

$this->di->setShared('app.log.plivo', function() {
    $logger = new \Phalcon\Logger\Adapter\File(APP_ROOT.'/logs/'.'plivo_log-'.date('Y-m-d').'.log');
    return $logger;
});

$this->di->setShared('app.log.request', function() {
    $logger = new \Phalcon\Logger\Adapter\File(APP_ROOT.'/logs/'.'request_log-'.date('Y-m-d').'.log');
    return $logger;
});