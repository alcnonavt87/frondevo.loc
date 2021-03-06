<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'site1' => 'https://frondevo.com',
    'site2' => 'https://frondevo.kiev.ua',
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
                    'height' => 1100,
                ],
                'mediumbg' => [
                    'width' => 1178,
                    'height' => 736,
                ],
                'smallbg' => [
                    'width' => 640,
                    'height' => 1171,
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
        'worksfrontout' => [ //работы фронтендаутсорсинг
            'path' => 'p/worksfrontout/',
            'sizes' => [
                'worksfrontout' => [
                    'width' => 297,
                    'height' => 381,
                ],

            ],

        ],
        'pages' => [
            'path' => 'p/pages/',

                'sizes' => [
                    'generalbgsbk' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'mediumbgsbk' => [
                        'width' => 1487,
                        'height' => 736,
                    ],
                    'smallbgsbk' => [
                        'width' => 640,
                        'height' => 1171,
                    ],
                    'bigsbk' => [
                        'width' => 940,
                        'height' => 275,
                    ],
                    'mediumsbk' => [
                        'width' => 461,
                        'height' => 275,
                    ],
                    'imagefrontoutbgbig' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'imagefrontoutbgsmall' => [
                        'width' => 640,
                        'height' => 1171,
                    ],
                    'imagepsd2html5bgbig' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'imagepsd2html5bgsmall' => [
                        'width' => 640,
                        'height' => 1171,
                    ],
                    'imagejavascriptbgbig' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'imagejavascriptbgsmall' => [
                        'width' => 640,
                        'height' => 1171,
                    ],
                    'imageangularbgbig' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'imageangularbgsmall' => [
                        'width' => 640,
                        'height' => 1171,
                    ],
                    'imagegamesbgbig' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'imagegamesbgsmall' => [
                        'width' => 640,
                        'height' => 1171,
                    ],
                    'imageanimationsbgbig' => [
                        'width' => 1920,
                        'height' => 1100,
                    ],
                    'imageanimationsbgsmall' => [
                        'width' => 640,
                        'height' => 1171,
                    ],

                ],

        ],

    ],
];