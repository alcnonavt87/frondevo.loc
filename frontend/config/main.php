<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
            'baseUrl' => '',
            'enableCsrfValidation'=>false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'email' => 'email',
                'email/<id>' => 'email',
                'email/<id>/<id2>' => 'email',
                'email/<id>/<id2>/<id3>' => 'email',
				'api' => 'api',
                'api/<id>' => 'api',
                'api/<id>/' => 'api',
                'api/<id>/<id2>' => 'api',
                'api/<id>/<id2>/' => 'api',
                'api/<id>/<id2>/<id3>' => 'api',
                'api/<id>/<id2>/<id3>/' => 'api',
				'' => 'root',
                '<id>' => 'root',
                '<id>/' => 'root',
                '<id>/<id2>' => 'root',
                '<id>/<id2>/' => 'root',
                '<id>/<id2>/<id3>' => 'root',
                '<id>/<id2>/<id3>/' => 'root',
                '<id>/<id2>/<id3>/<id4>' => 'root',
                '<id>/<id2>/<id3>/<id4>/' => 'root',
            ]
        ],
    ],
    'params' => $params,
];