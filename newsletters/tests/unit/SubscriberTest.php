<?php

use Wn\Newsletters\Subscriber;

class SubscriberTest extends \Codeception\Test\Unit
{
    public function testGettersAndSetters()
    {
        $s = new Subscriber('Foo', 'foo@bar.baz');
        $this->assertEquals('Foo', $s->name());
        $this->assertEquals('foo@bar.baz', $s->email());

        $s->name('Bar');
        $this->assertEquals('Bar', $s->name());

        $s->email('bar@foo.baz');
        $this->assertEquals('bar@foo.baz', $s->email());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExceptionIfInvalidEmail()
    {
        $s = new Subscriber('Foo', 'foo');
    }
}