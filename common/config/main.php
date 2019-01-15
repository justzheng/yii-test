<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'queue' => [
            'class' => 'shmilyzxt\queue\queues\RedisQueue',
            'jobEvent' => [
                'on beforeExecute' => ['shmilyzxt\queue\base\JobEventHandler','beforeExecute'],
                'on beforeDelete' => ['shmilyzxt\queue\base\JobEventHandler','beforeDelete'],
            ],
            'connector' => [ //需要安装 predis\predis 扩展来操作redis
                'class' => 'shmilyzxt\queue\connectors\PredisConnector',
                'parameters' => [
                    'scheme' => 'tcp',
                    'host' => '127.0.0.1',
                    'port' => 6379,
                    //'password' => '1984111a',
                    'db' => 0
                ],
                'options'=> [],
            ],
            'queue' => 'default',
            'expire' => 30,
            'maxJob' => 0,
            'failed' => [
                'logFail' => true,
                'provider' => [
                    'class' => 'shmilyzxt\queue\failed\DatabaseFailedProvider',
                    'db' => [
                        'class' => 'yii\db\Connection',
                        'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
                        'username' => 'root',
                        'password' => '',
                        'charset' => 'utf8',
                    ],
                    'table' => 'failed_jobs'
                ],
            ],
        ]
    ],
];
