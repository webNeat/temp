<?php

use Wn\Newsletters\Email\Notification;
use Wn\Newsletters\Event;

require __DIR__ . '/bootstrap.php';

// Sample event class
class AwesomeEvent extends Event {
	public function getNotificationContent()
	{
		return "Awesome Notification Content";
	}
}

$notification = (new Notification('Awesome Notification', ''))
	->addList($listA)
	->addList($listC);

$event = new AwesomeEvent;
$event->subscribe($notification);

$event->notify();