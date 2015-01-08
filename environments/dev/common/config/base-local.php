<?php
return [
    'components'=>[
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
    ]
];