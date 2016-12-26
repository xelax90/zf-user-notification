<?php
namespace XelaxUserNotification;

return [
	Module::CONFIG_KEY => [
		/* 
		 * The address from which system notifications are sent 
		 */
		//'system_notification_from' => ['email' => 'dev@dev.dev', 'name' => 'Dev Dev'],
		
		/* 
		 * Translator keys for E-Mail templates. These are translated by the 
		 * MvcTranslator to obtain the actual template paths depending on the
		 * receiver's language
		 */
		//'default_notification_template' => [
		//	RenderAndMailHandler::TEMPLATE_KEY_SUBJECT => 'email.default_notification_subject',
		//	RenderAndMailHandler::TEMPLATE_KEY_HTML => 'email.default_notification_html',
		//	RenderAndMailHandler::TEMPLATE_KEY_TEXT => 'email.default_notification_text'
		//],
		
		/* 
		 * Template engine used to render the e-mails 
		 */
		//'mail_renderer' => PhpRenderer::class,
		
		/*
		 * Mail transport service
		 */
		//'mail_transport' => TransportInterface::class,
		
		/*
		 * Mapping of notification types to notification handlers.
		 * You can use the wildcard type to call a handler for each notification
		 * The handlers will be called by the 
		 * XelaxUserNotification\Listener\NotificationListener event listener.
		 * If multiple handlers match one notification, then all of them are
		 * executed
		 */
		//'handler_map' => [
		//	'*' => [RenderAndMailHandler::class],
		//],
	],
];