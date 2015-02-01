<?php
return [
    'components'=>[
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache'
        ],
        'db' => [
            'enableSchemaCache'=>true
        ],
        'mailer' => [
            'useFileTransport' => false
        ],

        'log'=>[
            'targets'=>[
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'except' => ['yii\web\HttpException:*'],
                    'levels' => ['error', 'warning'],
                    'message' => ['from' => 'robot@example.com', 'to' => getenv('ADMIN_EMAIL')],
                ]
            ]
        ]
    ]
];