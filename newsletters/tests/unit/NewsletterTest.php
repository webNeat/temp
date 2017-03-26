<?php
/**
 * This tests the Email and MultiEmail methods via the
 * Newsletter class. The Newsletter::send() method is
 * tested in the acceptance tests since it calls other
 * classes.
 */

use Wn\Newsletters\Email\Newsletter;
use Wn\Newsletters\Interfaces\Sender;
use Wn\Newsletters\SubscribersList;

class NewsletterTest extends \Codeception\Test\Unit
{
    public function testGettersAndSetters()
    {
        $newsletter = new Newsletter('Hi', 'Hello World');
        $this->assertEquals('Hi', $newsletter->subject());
        $this->assertEquals('Hello World', $newsletter->body());
        $this->assertEquals([], $newsletter->lists());
        $this->assertEquals(-1, $newsletter->time());

        $newsletter->subject('Yo');
        $this->assertEquals('Yo', $newsletter->subject());

        $newsletter->body('How are you ?');
        $this->assertEquals('How are you ?', $newsletter->body());
    }

    public function testAddAndRemoveLists()
    {
        $newsletter = new Newsletter('Hi', 'Hello World');

        $listA = new SubscribersList('A');
        $listB = new SubscribersList('B');
        
        $newsletter->addList($listA)->addList($listB);
        $this->assertEquals([$listA, $listB], array_values($newsletter->lists()));

        $newsletter->removeList($listA);
        $this->assertEquals([$listB], array_values($newsletter->lists()));

        $newsletter->addList($listB);
        $this->assertEquals([$listB], array_values($newsletter->lists()));

        $newsletter->removeList($listA);
        $this->assertEquals([$listB], array_values($newsletter->lists()));

        $newsletter->removeList($listB);
        $this->assertEquals([], $newsletter->lists());
    }

    public function testSchedule()
    {
        $newsletter = new Newsletter('Hi', 'Hello World');
        $now = time();
        $newsletter->schedule($now + 60); // after 1 minute
        $this->assertEquals($now + 60, $newsletter->time());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExceptionWhenSchedulingInThePast()
    {
        $newsletter = new Newsletter('Hi', 'Hello World');
        $now = time();
        $newsletter->schedule($now - 60);
    }
}