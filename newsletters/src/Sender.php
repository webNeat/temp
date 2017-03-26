<?php
namespace Wn\Newsletters;

use Wn\Newsletters\Subscriber;
use Wn\Newsletters\Email\Email;

class Sender {

    /**
     * The unique instance of the sender.
     * 
     * @var self
     */
    protected static $instance = null;

    /**
     * Private constructor.
     */
    private function __construct() {}

    /**
     * Returns the sender instance.
     * 
     * @return self
     */
    public function get()
    {
        if (null === self::$instance)
            self::$instance = new Sender;
        return self::$instance;
    }

    /**
     * Sends an email to a subscriber.
     * 
     * @param  Email      $email
     * @param  Subscriber $subscriber
     * @return self
     */
    public function send(Email $email, Subscriber $subscriber)
    {
        echo "Recipient: {$subscriber->name()} <{$subscriber->email()}>", PHP_EOL,
             "Subject: {$email->subject()}", PHP_EOL, PHP_EOL,
             "{$email->body()}", PHP_EOL,
             "---", PHP_EOL;
        
        return $this;
    }
}