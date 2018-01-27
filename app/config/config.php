<?php

return [

	'database' => [
		'adapter'     => 'Mysql',
		'host'        => 'localhost',
		'username'    => 'root',
		'password'    => '',
		'dbname'      => 'bandmanager_old'
	],
	'application' => [
		'controllersDir' 	=> __DIR__ . '/../../app/controllers/',
		'modelsDir'      	=> __DIR__ . '/../../app/models/',
		'viewsDir'       	=> __DIR__ . '/../../app/views/',
		'host'				=> 'https://bandmanager-old.herokuapp.com',
        'mode'              => 'dev'
	],
    'tester'    => [
        'username'  => '',
        'password'  => ''
    ],
    'admin'    => [
        'username'  => 'admin',
        'password'  => 'admin'
    ],
    'volt' => [
        'path' => __DIR__ . '/../volt/',
        'extension' => '.compiled',
        'separator' => '@',
        'stat' => true
    ],
    'facebook' => [
    	'app_id'				=> '',
    	'app_secret'			=> '',
    	'default_graph_version' => 'v2.5',
        'test_token'            => 'TEST_TOKEN'
    ],
    'plivo' => [
        'auth_id'               => 'PLIVO_AUTH_ID',
        'auth_token'            => 'PLIVO_AUTH_TOKEN'
    ],
    'google' => [
        'api_key'   => ''
    ]
];