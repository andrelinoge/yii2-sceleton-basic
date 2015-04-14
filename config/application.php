<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'        => 'basic',
    'basePath'  => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'  =>'ru-RU',

    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fRTvDd538AmsscFYltVdwgfefRlwpKgT',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'showScriptName'  => false,
            'enablePrettyUrl' => true,
            'rules'           => require(__DIR__ . '/routing_rules.php')
        ]
    ],
    'modules' => [
        'dashboard' => [
            'class' => 'app\modules\dashboard\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_ENV) 
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class'      => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [
            // generator name
            'giiant-model' => [
                //generator class
                'class'     => 'schmunk42\giiant\model\Generator',
                //setting for out templates
                'templates' => [
                    // template name => path to template
                    'mymodel' =>
                        '@app/giiTemplates/model/default',
                ]
            ]
        ],
    ];
}

return $config;
