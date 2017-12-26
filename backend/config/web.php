<?php
$config = [
    'homeUrl' => Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'ico/index',
    'controllerMap' => [
        'file-manager-elfinder' => [
            'class' => mihaildev\elfinder\Controller::class,
            'access' => ['manager'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@storageUrl',
                    'basePath' => '@storage',
                    'path' => '/',
                    'access' => ['read' => 'manager', 'write' => 'manager']
                ]
            ]
        ]
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY'),
            'baseUrl' => env('BACKEND_BASE_URL')
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
        'reCaptcha' => [
               'name' => 'reCaptcha',
               'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
               'siteKey' => env('CAPTCHA_SITEKEY'),
               'secret' => env('CAPTCHA_SECRET'),
               ],
        'qrcode' => [
            'class' => 'Da\QrCode\Component\QrCodeComponent',
            //'label' => 'Tickcoin.co',
            'size' => 320 // big and nice :D
            // ... you can configure more properties of the component here
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => env('USERNAME_EMAIL'),
                'password' => env('PASSWORD_EMAIL'),
                'port' => '587',
               // 'port' => '465',
                'encryption' => 'tls', 
            ],
            //'useFileTransport' => true,
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => env('ADMIN_EMAIL')
            ]
        ],
    ],
    'modules' => [
        'i18n' => [
            'class' => backend\modules\i18n\Module::class,
            'defaultRoute' => 'i18n-message/index'
        ],
        'api' => [
            'class' => 'backend\modules\api\Module',
            'modules' => [
                'v1' => 'backend\modules\api\v1\Module'
            ]
        ],        
    ],
    'as globalAccess' => [
        'class' => common\behaviors\GlobalAccessBehavior::class,
        'rules' => [
            [
                'controllers' => ['api/v1/notification'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['alert']
            ],
            [
                'controllers' => ['login'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['index']
            ],
            [
                'controllers' => ['account'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['forgot-password','activation']
            ],
            [
                'controllers' => ['register'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['index']
            ],            
            [
                'controllers' => ['logout'],
                'allow' => true,
                'roles' => ['@'],
                'actions' => ['index']
            ],
            [
                'controllers' => ['authen'],
                'allow' => true,
                'roles' => ['@'],
                'actions' => ['index']
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions' => ['error']
            ],
            [
                'controllers' => ['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'controllers' => ['user'],
                'allow' => true,
                'roles' => ['administrator'],
            ],
            [
                'allow' => true,
                'roles' => ['user'],
            ],
            [
                'allow' => true,
                'roles' => ['manager'],
            ]
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'generators' => [
            'crud' => [
                'class' => yii\gii\generators\crud\Generator::class,
                'templates' => [
                    'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates')
                ],
                'template' => 'yii2-starter-kit',
                'messageCategory' => 'backend'
            ]
        ]
    ];
}

return $config;
