<?php
return [
		'adminEmail' => 'admin@example.com',

		'works' => [
				'countPerPage' =>10, //кол-во предложений на страницу (пагинация)
		],

		'viewsParts' => [ //месторасположение частей отображений
				'module1ItemCard' => '/parts/module1ItemCard',
				'popupl' => '/parts/popups/popupl',
		],

		'emails' => [ //конфигурация почты
				'from' => 'from@frondevo.com.ua',
				'to' => [
						'krekotenko@gmail.com',

					//'to3@com.ua',
				],
				'list' => [

				],
		],
];