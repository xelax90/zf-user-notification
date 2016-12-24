<?php
namespace XelaxUserNotification\Listener\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use XelaxUserNotification\Listener\UserListener;

/**
 * Creates UserListener instance
 *
 * @author schurix
 */
class UserListenerFactory implements FactoryInterface{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		$em = $container->get(EntityManager::class);
		
		return new UserListener($em);
	}
}
