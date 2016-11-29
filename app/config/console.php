<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gisgkh'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'modules' => [
        'gisgkh' => [
            'class' => 'opengkh\gis\Module',
            'version' => '10.0.2.10',
            'sslCert' => '@app/config/cert.pem',
            'sslKey' => '@app/config/key.pem',
            'caInfo' => '@app/config/cacert.pem',
            'username' => 'sit',
            'password' => 'rZ_GG72XS^Vf55ZW',
            'ip' => '217.107.108.147',
            'port' => '10081',
        ]
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
