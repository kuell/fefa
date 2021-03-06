<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'homestead',
			'username'  => 'homestead',
			'password'  => 'secret',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'fefa',
			'username' => 'postgres',
			'password' => 'aporedux',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),
        'frigodatas' => array(
            'driver'   => 'pgsql',
            'host'     => 'localhost',
            'database' => 'fefa',
            'username' => 'postgres',
            'password' => 'aporedux',
            'charset'  => 'WIN1252',
            'prefix'   => '',
            'schema'   => 'public',
        ),
        'frigodata' => array(
            'driver'   => 'pgsql',
            'host'     => '192.168.1.9',
            'database' => 'juti',
            'username' => 'frizelobackup',
            'password' => 'fribackup2015',
            'charset'  => 'WIN1252',
            'prefix'   => '',
            'schema'   => 'public',
        ),
        'brazpeli' => array(
            'driver'   => 'pgsql',
            'host'     => '10.1.1.247',
            'database' => 'brazpeli',
            'username' => 'postgres',
            'password' => '#fribackup2015',
            'charset'  => 'WIN1252',
            'prefix'   => '',
            'schema'   => 'public',
        ),

	),

);
