<?php
/**
 * This file holds the configuration of the application
 */
return [
	// The database configuration
	'db' => [
		'driver' => 'mysql',
		'host' 	=> 'localhost',
		'user' 	=> 'root',
		'pass' 	=> '',
		'name' 	=> 'mycorp'
	],
	// The pages configuration
	// Each page name is linked to a script path
	'pages' => [
		'newsletter' => 'src/controllers/newsletter.php',
		'not-found' => 'views/not-found.php'
	],
	'root_path' => __DIR__,
	'debug' => true
];