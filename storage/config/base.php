<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
return [
    'id' => 'storage',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'glide/index',
    'controllerMap' => [
        'glide' => '\trntv\glide\controllers\GlideController'
    ],
    'components' => [
        'urlManager'=>require(__DIR__.'/_urlManager.php'),
        'glide' => [
            'class' => 'trntv\glide\components\Glide',
            'sourcePath' => '@storage/web/source',
            'cachePath' => '@storage/cache',
            'maxImageSize' => env('GLIDE_MAX_IMAGE_SIZE'),
            'signKey' => env('GLIDE_SIGN_KEY')
        ]
    ]
];
