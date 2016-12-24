<?php

namespace XelaxUserNotification\Service;

use Zend\EventManager\EventManagerInterface;
use XelaxUserEntity\Entity\User;
use XelaxUserNotification\Notification\SystemNotification;
use XelaxUserNotification\Notification\UserNotification;
use XelaxUserNotification\Notification\NotificationInterface;
use XelaxUserNotification\Notification\NotificationPluginManager;

/**
 * Description of Notification
 *
 * @author schurix
 */
class Notification extends EventProvider{
	
	const EVENT_SYSTEM_NOTIFICATION = 'notification_system';
	const EVENT_USER_NOTIFICATION = 'notification_user';
	
	/** @var EventManagerInterface */
	protected $eventManager;
	
	/** @var NotificationPluginManager */
	protected $pluginManager;
	
	public function __construct(EventManagerInterface $eventManager, NotificationPluginManager $pluginManager) {
		$this->setEventManager($eventManager);
		$this->setPluginManager($pluginManager);
	}
	
	public function getEventManager() {
		return $this->eventManager;
	}

	protected function setEventManager(EventManagerInterface $eventManager) {
		$identifiers = [__CLASS__, static::class];
		$eventManager->setIdentifiers($identifiers);
		$this->eventManager = $eventManager;
		return $this;
	}
	
	public function getPluginManager() {
		return $this->pluginManager;
	}

	protected function setPluginManager(NotificationPluginManager $pluginManager) {
		$this->pluginManager = $pluginManager;
		return $this;
	}

	public function sendSystemNotification($type, User $reciever, $parameters, $notificationClass = null){
		if($notificationClass === null){
			$notificationClass = SystemNotification::class;
		}
		/* @var $notification SystemNotification */
		$notification = $this->getPluginManager()->get($notificationClass);
		$notification
				->setType($type)
				->setTo($reciever)
				->setParameters($parameters);
		$this->sendNotification(self::EVENT_SYSTEM_NOTIFICATION, $notification);
	}
	
	public function sendUserNotification($type, User $sender, User $reciever, $parameters, $notificationClass = null){
		if($notificationClass === null){
			$notificationClass = UserNotification::class;
		}
		/* @var $notification UserNotification */
		$notification = $this->getPluginManager()->get($notificationClass);
		$notification
				->setType($type)
				->setFrom($sender)
				->setTo($reciever)
				->setParameters($parameters);
		$this->sendNotification(self::EVENT_USER_NOTIFICATION, $notification);
	}
	
	public function sendNotification($eventName, NotificationInterface $notification){
		$this->getEventManager()->trigger($eventName, $notification);
	}
}
