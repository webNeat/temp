<?php
namespace Wn\Newsletters;

class Subscriber {

	/**
	 * The subscriber's name
	 * 
	 * @var string
	 */
	protected $name;

	/**
	 * The subscriber's email
	 * 
	 * @var string
	 */
	protected $email;

	/**
	 * Creates a new Subscriber.
	 * 
	 * @param string $name
	 * @param string $email
	 * @throws Exception if the given email is invalid
	 */
	public function __construct(string $name, string $email)
	{
		$this->email($email)
			 ->name($name);
	}

	/**
	 * If called with an argument sets the email
	 * If called without argument gets the email
	 * 
	 * @param  string $email 
	 * @return string|self
	 * @throws Exception if the given email is invalid
	 */
	public function email(string $email = null)
	{
		if (null === $email)
			return $this->email;

		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new \InvalidArgumentException("Email '{$email}' is invalid !");	
		}
		$this->email = $email;
		return $this;
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

}