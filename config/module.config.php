<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmuteban
 */

/**
 * @return array
 */
return [
	'dragonjsonserver' => [
	    'apiclasses' => [
	        '\DragonJsonServerAvatarmuteban\Api\Avatarmuteban' => 'Avatarmuteban',
	    ],
	],
	'service_manager' => [
		'invokables' => [
            '\DragonJsonServerAvatarmuteban\Service\Avatarmuteban' => '\DragonJsonServerAvatarmuteban\Service\Avatarmuteban',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAvatarmuteban_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAvatarmuteban/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAvatarmuteban\Entity' => 'DragonJsonServerAvatarmuteban_driver'
				],
			],
		],
	],
];
