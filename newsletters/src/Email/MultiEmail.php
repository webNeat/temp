<?php
namespace Wn\Newsletters\Email;

use Wn\Newsletters\SubscribersList;

/**
 * An email which can be sent to multiple lists.
 */
abstract class MultiEmail extends Email
{
	/**
	 * Subscribers lists.
	 * 
	 * @var array
	 */
	protected $lists = [];

	/**
	 * Adds a subscribers list.
	 * 
	 * @param SubscribersList $list
	 * @return self
	 */
	public function addList(SubscribersList $list)
	{
		$this->lists[$list->name()] = $list;
		return $this;
	}

	/**
	 * Removes a subscribers list.
	 * 
	 * @param SubscribersList $list
	 * @return self
	 */
	public function removeList(SubscribersList $list)
	{
		unset($this->lists[$list->name()]);
		return $this;
	}

	/**
	 * Gets the subscribers lists
	 * 
	 * @return array
	 */
	public function lists()
	{
		return $this->lists;
	}

	/**
	 * Sends the email to all subscribers on lists.
	 * The email is not sent twice to the same subscriber 
	 * even if he is present in different lists.
	 * 
	 * @return self
	 */
	public function send()
	{
		$subscribers = [];
		foreach ($this->lists as $list) {
			$subscribers = array_merge($subscribers, $list->subscribers());
		}

		foreach ($subscribers as $subscriber) {
			$this->sendTo($subscriber);
		}
		$this->time = time();
		return $this;
	}
}