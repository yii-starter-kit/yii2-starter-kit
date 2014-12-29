<?php
return [
    'components'=>[
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache'
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2-starter-kit', // localhost is much slower than 127.0.0.1
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache'=>true
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false
        ],

        /*'log'=>[
            'targets'=>[
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'except' => ['yii\web\HttpException:404'],
                    'levels' => ['error', 'warning'],
                    'message' => ['from' => 'robot@example.com', 'to' => getenv('ADMIN_EMAIL')],
                ]
            ]
        ]*/
    ]
];