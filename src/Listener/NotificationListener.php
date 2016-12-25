<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XelaxUserNotification\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;
use XelaxUserNotification\Service\Notification as NotificationService;
use XelaxUserNotification\Notification\Handler\HandlerPluginManager;
use XelaxUserNotification\Options\NotificationOptions;

/**
 * Description of NotificationListener
 *
 * @author schurix
 */
class NotificationListener extends AbstractListenerAggregate {
	
	/** @var HandlerPluginManager */
	protected $handlerPluginManager;
	/** @var NotificationOptions */
	protected $notificationOptions;
	
	public function __construct(HandlerPluginManager $handlerPluginManager, NotificationOptions $notificationOptions) {
		$this->handlerPluginManager = $handlerPluginManager;
		$this->notificationOptions = $notificationOptions;
	}
	
	public function getHandlerPluginManager() {
		return $this->handlerPluginManager;
	}

	public function getNotificationOptions() {
		return $this->notificationOptions;
	}

	public function setHandlerPluginManager(HandlerPluginManager $handlerPluginManager) {
		$this->handlerPluginManager = $handlerPluginManager;
		return $this;
	}

	public function setNotificationOptions(NotificationOptions $notificationOptions) {
		$this->notificationOptions = $notificationOptions;
		return $this;
	}
 
	public function attach(EventManagerInterface $events, $priority = 1) {
		$sharedManager = $events->getSharedManager();
		$this->listeners[] = $sharedManager->attach(NotificationService::class,   '*',          [$this, 'handleNotification'],     $priority);
	}
	
	/**
	 * @param Event $e
	 */
	public function handleNotification(Event $e){
		/* @var $notification \XelaxUserNotification\Notification\NotificationInterface */
		$notification = $e->getParam('notification');
		
		$handlerMap = $this->getNotificationOptions()->getHandlerMap();
		
		$handlers = [];
		if(isset($handlerMap[$notification->getType()])){
			$handlers = $handlerMap[$notification->getType()];
		} elseif(isset ($handlerMap['*'])) {
			$handlers = $handlerMap['*'];
		}
		
		$pm = $this->getHandlerPluginManager();
		foreach($handlers as $handlerName){
			/* @var $handler \XelaxUserNotification\Notification\Handler\HandlerInterface */
			$handler = $pm->get($handlerName);
			$handler->handle($notification);
		}
	}

}
