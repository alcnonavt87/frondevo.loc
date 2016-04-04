<?php
return [
		'adminEmail' => 'admin@example.com',

		'works' => [
				'countPerPage' =>2, //кол-во предложений на страницу (пагинация)
		],

		'viewsParts' => [ //месторасположение частей отображений
				'module1ItemCard' => '/parts/module1ItemCard',
				'popupl' => '/parts/popups/popupl',
		],

		'emails' => [ //конфигурация почты
				'from' => 'from@frondevo.com.ua',
				'to' => [
						'kanonir2012@gmail.com',
						'to2@com.ua',
					//'to3@com.ua',
				],
				'list' => [

				],
		],
];