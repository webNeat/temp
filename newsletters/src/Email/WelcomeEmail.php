<?php
namespace Wn\Newsletters\Email;

use Wn\Newsletters\Subscriber;

class WelcomeEmail extends Email {

	public function send(Subscriber $subscriber)
	{
		$this->sendTo($subscriber);
	}

}