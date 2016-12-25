<?php

namespace XelaxUserNotification\Notification\Handler\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use XelaxUserNotification\Notification\Handler\RenderAndMailHandler;
use XelaxUserNotification\Options\NotificationOptions;
use XelaxUserNotification\Module;

/**
 * Description of RenderAndMailHandlerFactory
 *
 * @author schurix
 */
class RenderAndMailHandlerFactory implements FactoryInterface{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		/* @var $notificationOptions NotificationOptions */
		$notificationOptions = $container->get(NotificationOptions::class);
		$renderer = $container->get($notificationOptions->getMailRenderer());
		$transport = $container->get($notificationOptions->getMailTransport());
		$defaultTemplate = $notificationOptions->getDefaultNotificationTemplate();
		
		$translator = $container->get('MvcTranslator');
		
		$config = $container->get('Config');
		$templateMap = [];
		if(isset($config[Module::CONFIG_KEY]['template_map'])){
			$templateMap = $config[Module::CONFIG_KEY]['template_map'];
		}
		
		return new RenderAndMailHandler($renderer, $defaultTemplate, $transport, $notificationOptions, $translator, $templateMap);
	}
}
