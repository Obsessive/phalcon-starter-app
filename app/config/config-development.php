<?php

return [

	'database' => [
		'adapter'     => 'Mysql',
		'host'        => 'localhost',
		'username'    => '',
		'password'    => '',
		'dbname'      => 'database'
	],
	'application' => [
		'controllersDir' 	=> __DIR__ . '/../../app/controllers/',
		'modelsDir'      	=> __DIR__ . '/../../app/models/',
		'viewsDir'       	=> __DIR__ . '/../../app/views/',
		'host'				=> 'http://myDomain.dev',
        'mode'              => 'dev'
	],
    'tester'    => [
        'username'  => '',
        'password'  => ''
    ],
    'admin'    => [
        'username'  => '',
        'password'  => ''
    ],
    'volt' => [
        'path' => __DIR__ . '/../volt/',
        'extension' => '.compiled',
        'separator' => '@',
        'stat' => true
    ],
    'facebook' => [
    	'app_id'				=> 'APP_ID',
    	'app_secret'			=> 'APP_SECRET',
    	'default_graph_version' => 'v2.5',
        'test_token'            => 'TEST_TOKEN'
    ],
    'plivo' => [
        'auth_id'               => 'PLIVO_AUTH_ID',
        'auth_token'            => 'PLIVO_AUTH_TOKEN'
    ],
    'google' => [
        'api_key'   => 'GOOGLE_API_KEY'
    ]
];