<?php

$view = '/views/not-found.php';

if (isset($_GET['id'])) {
	$newsletters = $database->fetch('SELECT * FROM newsletters WHERE id=:id LIMIT 1', [
		'id' => $_GET['id']
	]);

	if (! empty($newsletters)) {
		$newsletter = $newsletters[0];
		$view = '/views/newsletter.php';
	}
}

require $config['root_path'] . $view;