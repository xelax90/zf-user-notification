<?php

namespace XelaxUserNotification\Notification\Handler;

use XelaxUserNotification\Notification\NotificationInterface;

/**
 *
 * @author schurix
 */
interface HandlerInterface {
	
	/**
	 * Handles a notification
	 * @param NotificationInterface $notification
	 */
	public function handle(NotificationInterface $notification);
	
}
