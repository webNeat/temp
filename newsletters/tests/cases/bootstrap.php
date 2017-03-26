<?php
/**
 * Defines the subscribers and lists to be used on tests.
 */
use Wn\Newsletters\SubscribersList;
use Wn\Newsletters\Subscriber;

require __DIR__ . '/../../vendor/autoload.php';

// Subscribers
$foo = new Subscriber('Foo', 'foo@example.org');
$bar = new Subscriber('Bar', 'bar@example.org');
$baz = new Subscriber('Baz', 'baz@example.org');
$lorem = new Subscriber('Lorem', 'lorem@example.org');

// Lists
$listA = (new SubscribersList('A'))
	->addSubscriber($foo)
	->addSubscriber($bar);
$listB = (new SubscribersList('B'))
	->addSubscriber($lorem)
	->addSubscriber($baz);
$listC = (new SubscribersList('C'))
	->addSubscriber($foo)
	->addSubscriber($baz);
