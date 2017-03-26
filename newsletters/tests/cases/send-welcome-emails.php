<?php

use Wn\Newsletters\Email\WelcomeEmail;

require __DIR__ . '/bootstrap.php';

$welcome = new WelcomeEmail('Welcome', 'Welcome friend !');
$getStarted = new WelcomeEmail('Get Started', 'Let\'s write a "Hello World" !');

$listA->addWelcomeEmail($welcome);
$listB->addWelcomeEmail($welcome)
	  ->addWelcomeEmail($getStarted);

$listA->addSubscriber($lorem); // this should send the welcome email
$listB->addSubscriber($baz); // already there, no email be sent
$listB->addSubscriber($foo); // this should sent two welcome emails