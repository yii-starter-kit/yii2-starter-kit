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
                        'clientId' => 'insert-your-client-id',
                        'clientSecret' => 'insert-your-client-secret',
                    ]
                ],
            ],
        ]
    ]
);