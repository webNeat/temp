<?php
namespace Wn\Newsletters;

use Wn\Newsletters\Email\WelcomeEmail;
use Wn\Newsletters\Subscriber;

class SubscribersList {

	/**
	 * The list's name
	 * 
	 * @var string
	 */
	protected $name;

	/**
	 * The array of subscribers
	 * 
	 * @var array
	 */
	protected $subscribers;

	/**
	 * Welcome emails
	 * 
	 * @var array
	 */
	protected $welcomeEmails;

	/**
	 * Creates a new Subscribers List.
	 * 
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		$this->name = $name;
		$this->subscribers = [];
		$this->welcomeEmails = [];
	}

	/**
	 * If called with an argument sets the name
	 * If called without argument gets the name
	 * 
	 * @param  string $name 
	 * @return string|self
	 */
	public function name(string $name = null)
	{
		if (null === $name)
			return $this->name;

		$this->name = $name;
		return $this;
	}

	/**
	 * Returns the array of subscribers
	 * 
	 * @return array
	 */
	public function subscribers()
	{
		return $this->subscribers;
	}

	/**
	 * Returns the array of welcome emails
	 * 
	 * @return array
	 */
	public function welcomeEmails()
	{
		return $this->welcomeEmails;
	}

	/**
	 * Adds a subscriber to the list.
	 * Assumes that no two subscriber have the same email address.
	 * Adding the same subscriber multiple time will not duplicate it.
	 * 
	 * @param Subscriber $subscriber
	 * @return self
	 */
	public function addSubscriber(Subscriber $subscriber)
	{
		if (! isset($this->subscribers[$subscriber->email()])) {
			$this->subscribers[$subscriber->email()] = $subscriber;
			foreach ($this->welcomeEmails as $email) {
				$email->send($subscriber);
			}
		}
		return $this;
	}

	/**
	 * Removes a subscriber from the list.
	 * If the subscriber doesn't exist in the list; nothing happens.
	 * 
	 * @param  Subscriber $subscriber
	 * @return self
	 */
	public function removeSubscriber(Subscriber $subscriber)
	{
		unset($this->subscribers[$subscriber->email()]);
		return $this;
	}

	/**
	 * Adds a welcome email to the list.
	 * Assumes that no two welcome emails have the same subject.
	 * Adding the same welcome email multiple time will not duplicate it.
	 * 
	 * @param WelcomeEmail $email
	 * @return self
	 */
	public function addWelcomeEmail(WelcomeEmail $email)
	{
		$this->welcomeEmails[$email->subject()] = $email;
		return $this;
	}

	/**
	 * Removes a welcome email from the list.
	 * 
	 * @param  WelcomeEmail $email
	 * @return self
	 */
	public function removeWelcomeEmail(WelcomeEmail $email)
	{
		unset($this->welcomeEmails[$email->subject()]);
		return $this;
	}
}