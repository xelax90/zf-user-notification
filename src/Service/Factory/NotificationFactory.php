<?php

namespace XelaxUserNotification\Service\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\EventManager\EventManager;
use XelaxUserNotification\Service\Notification;

/**
 * Description of NotificationFactory
 *
 * @author schurix
 */
class NotificationFactory implements FactoryInterface{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		$events = $container->get(EventManager::class);
		return new Notification($events);
	}
}
