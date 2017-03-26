<?php
namespace Wn\Newsletters;

use Wn\Newsletters\Email\Notification;

abstract class Event
{
	/**
	 * notification emails to send when this event is fired.
	 * 
	 * @var array
	 */
	protected $notifications;

	/**
	 * Adds a notification email.
	 * 
	 * @param  Notification $email
	 * @return self
	 */
	public function subscribe(Notification $email)
	{
		$this->notifications[$email->subject()] = $email;
		return $this;
	}

	/**
	 * Removes a notification email.
	 * 
	 * @param  Notification $email
	 * @return self
	 */
	public function unsubscribe(Notification $email)
	{
		unset($this->notifications[$email->subject()]);
		return $this;		
	}

	/**
	 * Sends the notifications.
	 * 
	 * @return self
	 */
	public function notify()
	{
		foreach ($this->notifications as $email) {
			$email->notify($this->getNotificationContent());
		}
		return $this;
	}

	/**
	 * Gets the content to pass to notifications.
	 * 
	 * @return string
	 */
	abstract public function getNotificationContent();
}