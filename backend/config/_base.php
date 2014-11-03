<?php
return [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'homeUrl'=>Yii::getAlias('@backendUrl'),
    'components' => [
        'urlManager'=>require(__DIR__.'/_urlManager.php'),
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];