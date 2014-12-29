<?php
return [
    'components'=>[
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2-starter-kit', // localhost is much slower than 127.0.0.1
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => 'noreply@yii2-starter-kit.localhost',
            ]
        ],
    ]
];