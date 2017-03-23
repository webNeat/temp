<?php
/**
 * This file defines the global variables of the application
 */
require __DIR__.'/src/Database.php';

$config = require __DIR__.'/config.php';

if ($config['debug']) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

$database = new Database($config['db']['driver'], $config['db']['host'],
	$config['db']['name'], $config['db']['user'], $config['db']['pass']);
