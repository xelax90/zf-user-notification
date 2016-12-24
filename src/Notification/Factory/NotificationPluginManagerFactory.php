<?php
namespace XelaxUserNotification\Notification\Factory;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use XelaxUserNotification\Notification\NotificationPluginManager;
use Interop\Container\ContainerInterface;

/**
 * Description of NotificationPluginManagerFactory
 *
 * @author schurix
 */
class NotificationPluginManagerFactory extends AbstractPluginManagerFactory{
	
	const PLUGIN_MANAGER_CLASS = NotificationPluginManager::class;
	
	public function __invoke(ContainerInterface $container, $name, array $options = null) {
		if(!$options){
			$config = $container->get('Config');
			if(!empty($config['xelax_user_notification']['notification_plugin_manager'])){
				$options = $config['xelax_user_notification']['notification_plugin_manager'];
			}
		}
		parent::__invoke($container, $name, $options);
	}
}
