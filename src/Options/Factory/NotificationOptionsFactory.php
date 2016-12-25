<?php

namespace XelaxUserNotification\Options\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use XelaxUserNotification\Module;

/**
 * Description of NotificationOptionsFactory
 *
 * @author schurix
 */
class NotificationOptionsFactory implements FactoryInterface{
	const CONFIG_KEY = 'options';
	
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		$config = $container->get('Config');
		return new $requestedName(isset($config[Module::CONFIG_KEY][self::CONFIG_KEY]) ? $config[Module::CONFIG_KEY][self::CONFIG_KEY] : []);
	}
}
