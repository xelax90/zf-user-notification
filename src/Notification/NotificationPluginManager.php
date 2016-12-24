<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XelaxUserNotification\Notification;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * Description of NotificationPluginManager
 *
 * @author schurix
 */
class NotificationPluginManager extends AbstractPluginManager{
	
	protected $sharedByDefault = false;
	protected $instanceOf = NotificationInterface::class;
	
}
