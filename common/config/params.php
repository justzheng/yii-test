<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'junhuan' => [
        'sitecode' => 'zhApp_unionpay_cz',
        'code' => 'DA',
        'privatekey' => dirname(__FILE__) . '/../../certs/privatekey',
        'publickey' => dirname(__FILE__) . '/../../certs/publickey',
        'paymentpublickey' => dirname(__FILE__) . '/../../certs/smtsvsPubKey.dat',
    ],
    'junhuan2' => [
        'sitecode' => 'siteCode002',
        'code' => 'DA',
        'privatekey' => dirname(__FILE__) . '/../../certs2/privatekey',
        'publickey' => dirname(__FILE__) . '/../../certs2/publickey',
        'paymentpublickey' => dirname(__FILE__) . '/../../certs2/smtsvsPubKey.dat',
    ],
];
