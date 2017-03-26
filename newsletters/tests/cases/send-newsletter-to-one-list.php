<?php

use Wn\Newsletters\Email\Newsletter;
use Wn\Newsletters\SubscribersList;
use Wn\Newsletters\Subscriber;

require __DIR__ . '/bootstrap.php';

$newsletter = (new Newsletter('Hello', 'Hello World !'))
	->addList($listA);

$newsletter->send();