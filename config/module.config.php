<?php
namespace XelaxUserNotification;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
	/*'doctrine' => [
		'driver' => [
			__NAMESPACE__ . '_driver' => [
				'class' => AnnotationDriver::class, // use AnnotationDriver
				'cache' => 'array',
				'paths' => [__DIR__ . '/../src/Entity'] // entity path
			],
			'orm_default' => [
				'drivers' => [
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				]
			]
		],
	],*/
	
	'translator' => [
		'translation_file_patterns' => [
			[
				'type'     => 'phparray',
				'base_dir' => __DIR__ . '/../language',
				'pattern'  => '%s.php',
			],
		],
	],
	
	
	'view_manager' => [
		'template_path_stack' => [
			__DIR__ . '/../view',
		],
	],
];