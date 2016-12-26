<?php
namespace XelaxUserNotification\Notification;

use XelaxUserEntity\Entity\User;
use DateTime;

/**
 * Basic notification functionality
 * @author schurix
 */
interface NotificationInterface {
	/**
	 * Return the notification type
	 * @return type
	 */
	public function getType();
	
	/**
	 * Return the receiver
	 * @return User
	 */
	public function getTo();
	
	/**
	 * Return the creation time
	 * @return DateTime
	 */
	public function getCreatedAt();
	
	/**
	 * Return the notification parameters
	 * @return array
	 */
	public function getParameters();
	
	/**
	 * Set notification type. Must return self for fluent setters.
	 * @param type $type
	 * @return self
	 */
	public function setType($type);
	
	/**
	 * Set notification receiver. Must return self for fluent setters.
	 * @param User $to
	 * @return self
	 */
	public function setTo(User $to);
	
	/**
	 * Set creation time. Must return self for fluent setters.
	 * @param DateTime $createdAt
	 * @return self
	 */
	public function setCreatedAt(DateTime $createdAt);
	
	/**
	 * Set notification parameters. Must return self for fluent setters.
	 * @param array $parameters
	 * @return self
	 */
	public function setParameters(array $parameters);
}
