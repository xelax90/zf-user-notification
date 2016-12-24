<?php
namespace XelaxUserNotification\Notification;

use XelaxUserEntity\Entity\User;
use DateTime;

class BaseNotification implements NotificationInterface{
	/** @var int */
	protected $type;
	/** @var User */
	protected $to;
	/** @var DateTime */
	protected $createdAt;
	/** @var array */
	protected $parameters;
	
	public function __construct() {
		$this->createdAt = new DateTime();
	}
	
	public function getType() {
		return $this->type;
	}

	public function getTo() {
		return $this->to;
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function getParameters() {
		return $this->parameters;
	}

	public function setType($type) {
		$this->type = $type;
		return $this;
	}

	public function setTo(User $to) {
		$this->to = $to;
		return $this;
	}

	public function setCreatedAt(DateTime $createdAt) {
		$this->createdAt = $createdAt;
		return $this;
	}

	public function setParameters($parameters) {
		$this->parameters = $parameters;
		return $this;
	}
}