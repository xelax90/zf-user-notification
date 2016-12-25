<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XelaxUserNotification\Notification\Handler;

use XelaxUserNotification\Notification\NotificationInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\Mail\Transport\TransportInterface;
use Zend\Mail\MessageFactory;
use Zend\I18n\Translator\TranslatorInterface;
use ZF2LanguageRoute\Entity\LocaleUserInterface;
use XelaxUserNotification\Options\NotificationOptions;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Message as MimeMessage;

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
	/** @var TransportInterface */
	protected $transport;
	/** @var NotificationOptions */
	protected $notificationOptions;
	/** @var TranslatorInterface */
	protected $translator;
	
	public function __construct(RendererInterface $renderer, $defaultTemplate, TransportInterface $transport, NotificationOptions $notificationOptions, TranslatorInterface $translator, array $templateMap) {
		$this->setRenderer($renderer);
		$this->setDefaultTemplate($defaultTemplate);
		$this->setTemplateMap(array_merge($templateMap, $this->templateMap));
		$this->setTransport($transport);
		$this->setNotificationOptions($notificationOptions);
		$this->setTranslator($translator);
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
	
	public function getTransport() {
		return $this->transport;
	}
	
	public function getNotificationOptions() {
		return $this->notificationOptions;
	}

	public function getTranslator() {
		return $this->translator;
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
	
	public function setTemplate($messageType, $template){
		$this->templateMap[$messageType] = $template;
		return $this;
	}
	
	public function setTransport(TransportInterface $transport) {
		$this->transport = $transport;
		return $this;
	}
	
	public function setNotificationOptions(NotificationOptions $notificationOptions) {
		$this->notificationOptions = $notificationOptions;
		return $this;
	}

	public function setTranslator(TranslatorInterface $translator) {
		$this->translator = $translator;
		return $this;
	}
	
	public function handle(NotificationInterface $notification) {
		$templateKeys = $this->getTemplateKeys($notification);
		$subject = $this->renderTemplate($templateKeys[self::TEMPLATE_KEY_SUBJECT], $notification);
		$html = $this->renderTemplate($templateKeys[self::TEMPLATE_KEY_HTML], $notification);
		$text = $this->renderTemplate($templateKeys[self::TEMPLATE_KEY_TEXT], $notification);
		
		$message = $this->getMessage($notification, $subject, $html, $text);
		$transport = $this->getTransport();
		$transport->send($message);
	}
	
	protected function renderTemplate($templateKey, NotificationInterface $notification){
		$receiver = $notification->getTo();
		
		$translator = $this->getTranslator();
		// set locale to user-defined language
		$translatorLocale = $translator->getLocale();
		if($receiver instanceof LocaleUserInterface){
			$translator->setLocale($receiver->getLocale());
		}
		$template = $translator->translate($templateKey);
		// restore old locale
		$translator->setLocale($translatorLocale);
		
		return $this->getRenderer()->render($template, ['notification' => $notification]);
	}
	
	protected function getMessage(NotificationInterface $notification, $subject, $html, $text){
		
		$options = $this->getNotificationOptions();
		
		$message = MessageFactory::getInstance();
		$from = $options->getSystemNotificationFrom();
		$to = $notification->getTo();
		
		$textPart = new MimePart($text);
		$textPart->setType('text/plain')
				->setCharset('utf-8');
		
		$htmlPart = new MimePart($html);
		$htmlPart->setType('text/html')
				->setCharset('utf-8');
		
		$mimeBody = new MimeMessage();
		$mimeBody->setParts([$textPart, $htmlPart]);
		
		$message->setFrom($from['email'], $from['name'])
		        ->setEncoding('utf-8')
		        ->setSubject($subject)
		        ->setTo($to->getEmail(), $to->getDisplayName())
		        ->setBody($mimeBody);
		
		$message->getHeaders()->get('content-type')
		        ->addParameter('charset', 'UTF-8')
		        ->setType('multipart/alternative');
		
		return $message;
	}
	
	protected function getTemplateKeys(NotificationInterface $notification){
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
