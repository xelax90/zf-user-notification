<?php
namespace XelaxUserNotification\Notification\Handler;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager for notification handlers
 *
 * @author schurix
 */
class HandlerPluginManager extends AbstractPluginManager{
	protected $instanceOf = HandlerInterface::class;
	protected $factories = [
		RenderAndMailHandler::class => Factory\RenderAndMailHandlerFactory::class
	];
}
