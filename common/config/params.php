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
						'path' => 'p/works/',
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
								'generalmp' => [
										'width' => 900,
										'height' => 2560,
								],
								'bigmp' => [
										'width' => 704,
										'height' => 2002,
								],
								'mediummp' => [
										'width' => 390,
										'height' => 1109,
								],
								'smallmp' => [
										'width' => 296,
										'height' => 842,
								],
								'generaladd' => [
										'width' => 768,
										'height' => 491,
								],
						],

				],

			],
];