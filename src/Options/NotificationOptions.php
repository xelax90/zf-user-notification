<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XelaxUserNotification\Options;

use Zend\Stdlib\AbstractOptions;
use XelaxUserNotification\Notification\Handler\RenderAndMailHandler;
use Zend\View\Renderer\PhpRenderer;
use Zend\Mail\Transport\TransportInterface;

/**
 * 
 *
 * @author schurix
 */
class NotificationOptions extends AbstractOptions{
	protected $systemNotificationFrom = ['email' => 'dev@dev.dev', 'name' => 'Dev Dev'];
	
	protected $defaultNotificationTemplate = [
		 RenderAndMailHandler::TEMPLATE_KEY_SUBJECT => 'email.default_notification_subject',
		 RenderAndMailHandler::TEMPLATE_KEY_HTML => 'email.default_notification_html',
		 RenderAndMailHandler::TEMPLATE_KEY_TEXT => 'email.default_notification_text'
	];
	
	protected $mailRenderer = PhpRenderer::class;
	
	protected $mailTransport = TransportInterface::class;
	
	protected $handlerMap = ['*' => [RenderAndMailHandler::class]];
	
	public function getSystemNotificationFrom() {
		return $this->systemNotificationFrom;
	}

	public function getDefaultNotificationTemplate() {
		return $this->defaultNotificationTemplate;
	}

	public function getMailRenderer() {
		return $this->mailRenderer;
	}

	public function getMailTransport() {
		return $this->mailTransport;
	}

	public function setSystemNotificationFrom($systemNotificationFrom) {
		$this->systemNotificationFrom = $systemNotificationFrom;
		return $this;
	}

	public function setDefaultNotificationTemplate($defaultNotificationTemplate) {
		$this->defaultNotificationTemplate = $defaultNotificationTemplate;
		return $this;
	}

	public function setMailRenderer($mailRenderer) {
		$this->mailRenderer = $mailRenderer;
		return $this;
	}

	public function setMailTransport($mailTransport) {
		$this->mailTransport = $mailTransport;
		return $this;
	}
	
	public function getHandlerMap() {
		return $this->handlerMap;
	}

	public function setHandlerMap($handlerMap) {
		$this->handlerMap = $handlerMap;
		return $this;
	}
}
