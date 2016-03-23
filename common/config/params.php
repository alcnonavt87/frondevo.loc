<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    
	'defLang' => 'ua',
    'hostProtocol' => 'http://',
	
    'siteLangs' => [
		'ru',
		'en',
		
	],
	
    'pics' => [ //конфигурация картинок
		'module1' => [ //модуль1
			'path' => 'p/module1/',
			'sizes' => [
				'preview' => [
					'width' => 250,
					'height' => 250,
				],
			],
		],
	],
];