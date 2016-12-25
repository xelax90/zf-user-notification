<?php
namespace XelaxUserNotification\Listener\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use XelaxUserNotification\Listener\NotificationListener;
use XelaxUserNotification\Notification\Handler\HandlerPluginManager;
use XelaxUserNotification\Options\NotificationOptions;

/**
 * Creates UserListener instance
 *
 * @author schurix
 */
class NotificationListenerFactory implements FactoryInterface{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		$handlerPluginManager = $container->get(HandlerPluginManager::class);
		$notificationOptions = $container->get(NotificationOptions::class);
		
		return new NotificationListener($handlerPluginManager, $notificationOptions);
	}
}
