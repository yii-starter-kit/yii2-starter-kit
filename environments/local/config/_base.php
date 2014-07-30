<?php
return [
    'components'=>[
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ]
    ]
];