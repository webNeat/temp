<?php
namespace Wn\Newsletters\Email;

use Wn\Newsletters\Sender;

class Newsletter extends MultiEmail {

	/**
	 * The timestamp of when to send this newsletter.
	 * 
	 * @var int
	 */
	protected $time;

	/**
	 * Creates a new Newsletter.
	 * 
	 * @param string $subject
	 * @param string $body
	 */
	public function __construct(string $subject, string $body, Sender $sender = null)
	{
		parent::__construct($subject, $body, $sender);
		$this->time = -1;
	}

	/**
	 * Sends the newsletter to all subscribers on lists.
	 * The newsletter is not sent twice to the same subscriber 
	 * even if he is present in different lists.
	 * 
	 * @return self
	 */
	public function send()
	{
		parent::send();
		$this->time = time();
		return $this;
	}

	/**
	 * Schedules the newsletter to be sent at a specific timestamp.
	 * if the given timestamp is in the past; an exception is thrown.
	 * 
	 * @param  int $timestamp
	 * @return self
	 */
	public function schedule(int $timestamp)
	{
		if ($timestamp < time()) {
			throw new \InvalidArgumentException("The given schedule time is already in the past !");			
		}

		$this->time = $timestamp;
		return $this;
	}

	/**
	 * Returns the sending timestamp on this newsletter.
	 * A value of -1 means that the newsletter was never 
	 * sent. A value in the futur means that the it is 
	 * scheduled to be sent at that timestamp. 
	 * 
	 * @return int
	 */
	public function time()
	{
		return $this->time;
	}

}