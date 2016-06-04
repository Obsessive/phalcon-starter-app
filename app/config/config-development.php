<?php

return [

	'database' => [
		'adapter'     => 'Mysql',
		'host'        => 'localhost',
		'username'    => '',
		'password'    => '',
		'dbname'      => 'database',
	],
	'application' => [
		'controllersDir' => __DIR__ . '/../../app/controllers/',
		'modelsDir'      => __DIR__ . '/../../app/models/',
		'viewsDir'       => __DIR__ . '/../../app/views/',
		'baseUri'        => '/',
	],
    'volt' => [
        'path' => __DIR__ . '/../volt/',
        'extension' => '.compiled',
        'separator' => '@',
        'stat' => true
    ]
];