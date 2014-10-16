<?php
return \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/_base.php'),
    [
        'homeUrl'=>Yii::getAlias('@frontendUrl'),
        'components'=>[
            'authClientCollection' => [
                'class' => 'yii\authclient\Collection',
                'clients' => [
                    'github' => [
                        'class' => 'yii\authclient\clients\GitHub',
                        'clientId' => '237c5779f41e4c91c2db',
                        'clientSecret' => 'fde95f7fc0bbd7af0a77714fa5ebd3cffb8fd685',
                    ],
                    'facebook' => [
                        'class' => 'yii\authclient\clients\Facebook',
                        'clientId' => '1545417979005681',
                        'clientSecret' => '454f450656b9403d851a94235d9ecefc',
                    ]
                ],
            ],
        ]
    ]
);