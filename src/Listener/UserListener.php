<?php
namespace XelaxUserNotification\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

use Doctrine\Common\Persistence\ObjectManager;

use ZfcUser\Service\User as ZfcUserServce;

/**
 * Description of UserListener
 *
 * @author schurix
 */
class UserListener extends AbstractListenerAggregate {
	
	/** @var ObjectManager */
	protected $objectManager;
	
	function __construct(ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}

	public function attach(EventManagerInterface $events, $priority = 1) {
		$sharedManager = $events->getSharedManager();
		$this->listeners[] = $sharedManager->attach(ZfcUserServce::class,         'register.post',          [$this, 'postRegister'],     $priority);
	}
	
	/**
	 * @param Event $e
	 */
	public function postRegister(Event $e){
		/* @var $user \XelaxUserEntity\Entity\User */
		$user = $e->getParam('user');
		
		// TODO
	}
	
}
