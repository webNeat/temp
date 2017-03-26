<?php
namespace Wn\Newsletters\Email;

use Wn\Newsletters\Sender;
use Wn\Newsletters\Subscriber;

/**
 * The base Email class
 */
abstract class Email {

	/**
	 * The email's subject
	 * 
	 * @var string
	 */
	protected $subject;

	/**
	 * The email's body
	 * 
	 * @var string
	 */
	protected $body;

	/**
	 * An email sender.
	 * 
	 * @var Wn\Newsletters\Sender
	 */
	protected $sender;

	/**
	 * Creates a new Email instance.
	 * 
	 * @param string $subject
	 * @param string $body
	 */
	public function __construct(string $subject, string $body, Sender $sender = null)
	{
		if (null === $sender) {
			$sender = Sender::get();
		}

		$this->subject($subject)
			 ->body($body)
			 ->sender($sender);
	}

	/**
	 * subject getter and setter.
	 * 
	 * @param  string $subject
	 * @return string|self
	 */
	public function subject(string $subject = null)
	{
	    if (null === $subject) {
	        return $this->subject;
	    }
	    	
	    $this->subject = $subject;
	    return $this;
	}

	/**
	 * body getter and setter.
	 * 
	 * @param  string $body
	 * @return string|self
	 */
	public function body(string $body = null)
	{
	    if (null === $body) {
	        return $this->body;
	    }
	    	
	    $this->body = $body;
	    return $this;
	}

	/**
	 * sender getter and setter.
	 * 
	 * @param  Sender $sender
	 * @return Sender|self
	 */
	public function sender(Sender $sender = null)
	{
	    if (null === $sender) {
	        return $this->sender;
	    }
	    	
	    $this->sender = $sender;
	    return $this;
	}

	/**
	 * Sends the email to a subscriber.
	 * 
	 * @param  Subscriber $subscriber
	 * @return self
	 */
	protected function sendTo(Subscriber $subscriber)
	{
		$this->sender->send($this, $subscriber);
		return $this;
	}
}