<?php
namespace XelaxUserNotification\Notification\Handler\Factory;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use XelaxUserNotification\Notification\Handler\HandlerPluginManager;
use Interop\Container\ContainerInterface;
use XelaxUserNotification\Module;

/**
 * Description of NotificationPluginManagerFactory
 *
 * @author schurix
 */
class HandlerPluginManagerFactory extends AbstractPluginManagerFactory{
	const PLUGIN_MANAGER_CLASS = HandlerPluginManager::class;
	const CONFIG_KEY = 'handler_plugin_manager';
	
	public function __invoke(ContainerInterface $container, $name, array $options = null) {
		if(!$options){
			$config = $container->get('Config');
			if(!empty($config[Module::CONFIG_KEY][self::CONFIG_KEY])){
				$options = $config[Module::CONFIG_KEY][self::CONFIG_KEY];
			}
		}
		parent::__invoke($container, $name, $options);
	}
}
