<?php

use Wn\Newsletters\Email\WelcomeEmail;
use Wn\Newsletters\Subscriber;
use Wn\Newsletters\SubscribersList;

class SubscribersListTest extends \Codeception\Test\Unit
{
    public function testGettersAndSetters()
    {
        $list = new SubscribersList('List A');
        $this->assertEquals('List A', $list->name());
        $this->assertEquals([], $list->subscribers());

        $list->name('Bar');
        $this->assertEquals('Bar', $list->name());

    }

    public function testAddSubscribers()
    {
        $list = new SubscribersList('List A');
        // This should be a mock subscriber object,
        // but let's just keep it simple and use a 
        // real instance
        $foo = new Subscriber('Foo', 'foo@bar.baz');
        $bar = new Subscriber('Bar', 'bar@foo.baz');

        $list->addSubscriber($foo)->addSubscriber($bar);

        $this->assertEquals([$foo, $bar], array_values($list->subscribers()));

        $list->addSubscriber($foo);
        $this->assertEquals([$foo, $bar], array_values($list->subscribers()));
    }

    public function testRemoveSubscribers()
    {
        $list = new SubscribersList('List A');
        // This should be a mock subscriber object,
        // but let's just keep it simple and use a 
        // real instance
        $foo = new Subscriber('Foo', 'foo@bar.baz');
        $bar = new Subscriber('Bar', 'bar@foo.baz');

        $list->addSubscriber($foo)->addSubscriber($bar);

        $list->removeSubscriber($foo);
        $this->assertEquals([$bar], array_values($list->subscribers()));

        $list->removeSubscriber($foo);
        $this->assertEquals([$bar], array_values($list->subscribers()));

        $list->removeSubscriber($bar);
        $this->assertEquals([], $list->subscribers());
    }

    public function testAddWelcomeEmails()
    {
        $list = new SubscribersList('List A');
        $hi = new WelcomeEmail('Hi', 'Hello World');
        $yo = new WelcomeEmail('Yo', 'Welcome here');

        $list->addWelcomeEmail($hi)->addWelcomeEmail($yo);

        $this->assertEquals([$hi, $yo], array_values($list->welcomeEmails()));

        $list->addWelcomeEmail($hi);
        $this->assertEquals([$hi, $yo], array_values($list->welcomeEmails()));
    }

    public function testRemoveWelcomeEmails()
    {
        $list = new SubscribersList('List A');
        $hi = new WelcomeEmail('Hi', 'Hello World');
        $yo = new WelcomeEmail('Yo', 'Welcome here');

        $list->addWelcomeEmail($hi)->addWelcomeEmail($yo);

        $list->removeWelcomeEmail($hi);
        $this->assertEquals([$yo], array_values($list->welcomeEmails()));

        $list->removeWelcomeEmail($hi);
        $this->assertEquals([$yo], array_values($list->welcomeEmails()));

        $list->removeWelcomeEmail($yo);
        $this->assertEquals([], $list->welcomeEmails());
    }
}