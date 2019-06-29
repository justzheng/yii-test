<?php
return [
    'bootstrap' => ['commonQueue2'],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=47.92.226.55;dbname=yii2advanced',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'commonQueue2' => [
            'class' => 'yii\queue\redis\Queue',
            'redis' => 'yii2Redis',
            'channel' => 'common-queue2'
        ],
        'yii2Redis' => [
            'class' => '\yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 8
        ],
    ],
];
