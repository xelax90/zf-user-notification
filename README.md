# User notification module

This module provides an event-driven and simple user notification system. 

## Installation

Installation of XelaxUserNotification uses composer. For composer documentation, 
please refer to [getcomposer.org](http://getcomposer.org/).

```sh
composer require xelax90/zf-user-notification
```

Then add `XelaxUserNotification` to your `config/application.config.php` and run 
the doctrine schema update to create the database table:

```sh
php vendor/bin/doctrine-module orm:schema-tool:update --force 
```

Now copy the provided configuration files
`vendor/xelax90/zf-user-notification/config/xelax-user-notification.global.php` and
`vendor/xelax90/zf-user-notification/config/xelax-user-notification.local.php.dist` 
into your `config/autoload` directory. Also make another copy of the 
`xelax-user-notification.local.php.dist` file without the `.dist` extension.

## Configuration

To send notifications via E-Mail please enter your mailserver configuration in 
the `config/autoload/xelax-user-module.local.php` file.

You can use the global configuration in `config/autoload/xelax-user-module.global.php`
to modify E-Mail templates and other global settings. Every setting is documented
inside the configuration file.

## Sending notifications

To send a notification, get an instance of the 
`XelaxUserNotification\Service\Notification` Service from the Service Manager and
call one of the functions `sendSystemNotification` (For system-to-user notifications), 
`sendUserNotification` (For user-to-user notifications). These functions create 
an instance of `NotificationInterface` and trigger the corresponding event such
that any notification handler can handle the created notification. To send custom
events and notifications, use the `sendNotification` Method. 

## Handling notifications

To handle a notification, simply create an event listener that listens to 
events from the `XelaxUserNotification\Service\Notification` class. There are
two default events, namely `Notification::EVENT_SYSTEM_NOTIFICATION` and 
`Notification::EVENT_USER_NOTIFICATION` for the two different notification types.
There are some default notification handlers that you should maybe look at before
implementing additional logic.
