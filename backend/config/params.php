<?php
return [
    'adminEmail' => 'admin@example.com',
    
    /*
    *  ['94.178.176.174'], - реальный адрес
    *  ['94.178.0.0', '94.178.255.255'], - диапазон реальных адресов
    *  ['127.0.0.1'], - локальный адрес
    */
    'listIPs' => [
        ['127.0.0.1'],
    ],
    'defLang' => 'ua',
    'hostName' => 'http://frondevo.loc',
    
    'nameDB' => [
		'dev' => 'frondevo',
		'demo' => '',
		'prod' => '',
	],
    'insertRows' => 50,
    'dumpPath' => 'dump/',
    'blockingInnoDBT' => FALSE,
];