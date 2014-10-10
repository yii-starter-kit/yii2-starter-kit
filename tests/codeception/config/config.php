<?php
/**
 * Application configuration shared by all applications and test types
 */
return [
    'aliases'=>[
        '@frontendUrl'=>'127.0.0.1',
        '@backendUrl'=>'127.0.0.1'
    ],
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=yii2-starter-kit-tests',
            'username'=>'root'
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
