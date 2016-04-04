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
				'works' => [ //работы
						'path' => 'frontend/web/p/works/',
						'sizes' => [
								'general' => [
										'width' => 1024,
										'height' => 640,
								],
								'preview' => [
										'width' => 297,
										'height' => 381,
								],
								'bigsbk' => [
										'width' => 940,
										'height' => 275,
								],
								'mediumsbk' => [
										'width' => 461,
										'height' => 275,
								],
						],
				],
			],
];