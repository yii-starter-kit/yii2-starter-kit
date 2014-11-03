<?php
return [
    'id' => 'frontend',
    'basePath'=>dirname(__DIR__),
    'components' => [
        'user' => [
            'class'=>'yii\web\User',
            'loginUrl'=>'/user/sign-in/login',
            'enableAutoLogin' => true,
        ],
        'urlManager'=>require(__DIR__.'/_urlManager.php'),
    ],
];