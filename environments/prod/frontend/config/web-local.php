<?php
return \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/_base.php'),
    [
        'components'=>[
            'authClientCollection' => [
                'class' => 'yii\authclient\Collection',
                'clients' => [
                    'github' => [
                        'class' => 'yii\authclient\clients\GitHub',
                        'clientId' => 'your-client-id',
                        'clientSecret' => 'your-client-secret',
                    ],
                    'facebook' => [
                        'class' => 'yii\authclient\clients\Facebook',
                        'clientId' => 'your-client-id',
                        'clientSecret' => 'your-client-secret',
                    ]
                ],
            ],

            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => '',
            ],

        ],

    ]
);