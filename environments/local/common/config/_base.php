<?php
require('_bootstrap.php');
return [
    'components'=>[
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'db'=> require(__DIR__ . '/_db.php'),
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
    ]
];