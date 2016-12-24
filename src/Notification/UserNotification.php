<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XelaxUserNotification\Notification;

use XelaxUserEntity\Entity\User;

/**
 * User to User Notification
 *
 * @author schurix
 */
class UserNotification extends BaseNotification{
	/** @var User */
	protected $from = null;
	
	public function setFrom(User $from = null) {
		$this->from = $from;
		return $this;
	}
	
	public function getFrom() {
		return $this->from;
	}
}
