<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XelaxUserNotification\Notification\Handler;

use XelaxUserNotification\Notification\NotificationInterface;
use Zend\View\Renderer\RendererInterface;

/**
 * Description of RenderAndMailHandler
 *
 * @author schurix
 */
class RenderAndMailHandler implements HandlerInterface{
	const TEMPLATE_KEY_SUBJECT = 'subject';
	const TEMPLATE_KEY_HTML = 'html';
	const TEMPLATE_KEY_TEXT= 'text';
	
	/** @var RendererInterface */
	protected $renderer;
	/** @var string */
	protected $defaultTemplate;
	/** @var array */
	protected $templateMap = [];
	
	
	public function __construct(RendererInterface $renderer, $defaultTemplate, array $templateMap = []) {
		$this->renderer = $renderer;
		$this->defaultTemplate = $defaultTemplate;
		$this->templateMap = array_merge($templateMap, $this->templateMap);
	}
	
	public function getRenderer() {
		return $this->renderer;
	}

	public function getDefaultTemplate() {
		return $this->defaultTemplate;
	}

	public function getTemplateMap() {
		return $this->templateMap;
	}

	public function setRenderer(RendererInterface $renderer) {
		$this->renderer = $renderer;
		return $this;
	}

	public function setDefaultTemplate($defaultTemplate) {
		$this->defaultTemplate = $defaultTemplate;
		return $this;
	}

	public function setTemplateMap($templateMap) {
		$this->templateMap = $templateMap;
		return $this;
	}

	public function handle(NotificationInterface $notification) {
		$template = $this->getTemplate($notification);
		$subject = $this->getRenderer()->render($template[self::TEMPLATE_KEY_SUBJECT], ['notification' => $notification]);
		$html = $this->getRenderer()->render($template[self::TEMPLATE_KEY_HTML], ['notification' => $notification]);
		$text = $this->getRenderer()->render($template[self::TEMPLATE_KEY_TEXT], ['notification' => $notification]);
		
		
	}
	
	protected function getTemplate(NotificationInterface $notification){
		$template = $this->getDefaultTemplate();
		if(isset($this->templateMap[$notification->getType()])){
			$passedTemplate = $this->templateMap[$notification->getType()];
			if(isset($passedTemplate[self::TEMPLATE_KEY_SUBJECT])){
				$template[self::TEMPLATE_KEY_SUBJECT] = $passedTemplate[self::TEMPLATE_KEY_SUBJECT];
			}
			if(isset($passedTemplate[self::TEMPLATE_KEY_HTML])){
				$template[self::TEMPLATE_KEY_HTML] = $passedTemplate[self::TEMPLATE_KEY_HTML];
			}
			if(isset($passedTemplate[self::TEMPLATE_KEY_TEXT])){
				$template[self::TEMPLATE_KEY_TEXT] = $passedTemplate[self::TEMPLATE_KEY_TEXT];
			}
		}
		return $template;
	}
}
