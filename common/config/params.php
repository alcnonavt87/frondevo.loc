<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    
	'defLang' => 'ru',
    'hostProtocol' => 'http://',
	
    'siteLangs' => [
		'ua',
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
								'generalprtf' => [
										'width' => 1920,
										'height' => 345,
								],
								'generalbg' => [
										'width' => 1920,
										'height' => 1080,
								],
								'mediumbg' => [
										'width' => 1178,
										'height' => 736,
								],
								'smallbg' => [
										'width' => 768,
										'height' => 480,
								],
						],

				],

			],
];