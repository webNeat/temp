<?php
namespace Wn\Newsletters\Email;

use Wn\Newsletters\SubscribersList;
use Wn\Newsletters\Sender;

class Notification extends MultiEmail {

	/**
	 * Sends the notification email to all
	 * subscribers lists with the given content.
	 * 
	 * @param $content
	 * @return self
	 */
	public function notify(string $content)
	{
		$this->body($content);
		parent::send();
		return $this;
	}

}