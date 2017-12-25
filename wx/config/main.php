<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-wx',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'wx\controllers',
    'defaultRoute' => false,

    'charset' => 'utf-8',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',

    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            //'csrfParam' => '_csrf-wx',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-wx', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the wx
            'name' => 'advanced-wx',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['wxNews'],
                    'maxFileSize' => '',
                    'logFile' => '@runtime/logs/wxNews/'.date('Y_m_d').'.log',
                    'fileMode' => 0775,
                    'logVars' => ['_POST', '_GET']

                ]
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=video',
            'username' => 'root',
            'password' => 'yu1596321',
            'charset' => 'utf8',
        ],

    ],
    'params' => $params,
];
