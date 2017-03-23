<?php
/**
 * The entry point of the application. It calls a
 * controller based on the $_GET['page'] parameter
 */

require __DIR__ . '/../bootstrap.php';

$page = 'not-found';

if (isset($_GET['page']) && isset($config['pages'][$_GET['page']])) {
	$page = $_GET['page'];
}

require $config['root_path'] . '/' . $config['pages'][$page];