<?php
namespace XelaxUserNotification\Notification\Factory;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use XelaxUserNotification\Notification\NotificationPluginManager;
use Interop\Container\ContainerInterface;
use XelaxUserNotification\Module;

/**
 * Description of NotificationPluginManagerFactory
 *
 * @author schurix
 */
class NotificationPluginManagerFactory extends AbstractPluginManagerFactory{
	
	const PLUGIN_MANAGER_CLASS = NotificationPluginManager::class;
	const CONFIG_KEY = 'notification_plugin_manager';
	
	public function __invoke(ContainerInterface $container, $name, array $options = null) {
		if(!$options){
			$config = $container->get('Config');
			if(!empty($config[Module::CONFIG_KEY][self::CONFIG_KEY])){
				$options = $config[Module::CONFIG_KEY][self::CONFIG_KEY];
			}
		}
		return parent::__invoke($container, $name, $options);
	}
}
