<?php
return [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager'=>require(__DIR__.'/_urlManager.php')
    ],
];
