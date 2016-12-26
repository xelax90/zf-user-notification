<?php
namespace XelaxUserNotification;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface, BootstrapListenerInterface
{
	const CONFIG_KEY = 'xelax_user_notification';
	
	public function onBootstrap(EventInterface $e) {
		if(!$e instanceof MvcEvent){
			return;
		}
		
		$app = $e->getApplication();
		$eventManager = $app->getEventManager();
		$container = $app->getServiceManager();
		
		/* @var $notificationListener Listener\NotificationListener */
		$notificationListener = $container->get(Listener\NotificationListener::class);
		$notificationListener->attach($eventManager);
	}

	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}

	public function getServiceConfig() {
		return [
			'factories' => [
				Listener\NotificationListener::class => Listener\Factory\NotificationListenerFactory::class,
				Notification\NotificationPluginManager::class => Notification\Factory\NotificationPluginManagerFactory::class,
				Notification\Handler\HandlerPluginManager::class => Notification\Handler\Factory\HandlerPluginManagerFactory::class,
				Options\NotificationOptions::class => Options\Factory\NotificationOptionsFactory::class,
				Service\Notification::class => Service\Factory\NotificationFactory::class
			],
			'delegators' => [
			],
		];
	}

}