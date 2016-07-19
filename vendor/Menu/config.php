<?php

$config = [
	// конфигурация для работы с шаблонами
	'templates' => [
		'partsPath' => '/menu/',
		'main' => [
			'openName' => 'mainOpenCode',
			'closeName' => 'mainCloseCode',
			'item1Name' => 'mainItem1Code',
			'item1NameActive' => 'mainItem1CodeActive',
		],
	],
	// конфигурация для работы с css-классами
	'classes' => [
		'item1Active' => 'style="background-color:lightgreen;"',
	],
];

$menu = [
	'main' => [ //меню хедера => уровень, [алиас1, алиас2...]
		'level' => 1,
		'items' => [
			'index',
			'sitesbykeys',
			'portfolio',
			'frontendout',
			'contacts',

		]
	],
];