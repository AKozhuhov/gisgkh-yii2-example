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
            'version' => '10.0.2.3',
            'sslCert' => '@app/config/rgd20161023.pem',
            'sslKey' => '@app/config/rgd20161023.pem',
            'caInfo' => '@app/config/cacert3.pem',
            'username' => 'lanit',
            'password' => 'tv,n8!Ya',
            'ip' => '217.107.108.147',
            'port' => '10081',
            'classesPath' => '@app/gisgkh',
            'SenderId' => null,//'a319a81d-b10e-4d1e-b9e5-953f699bf301',
            'orgPPAGUID' => '4e254e2a-98a2-4006-af79-cee92cbec248'
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
