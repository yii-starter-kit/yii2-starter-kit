<?php
// Composer
require(__DIR__ . '/../../vendor/autoload.php');

// Environment
require(__DIR__ . '/../../common/Environment.php');
$environment = new Environment([
    //'envVar'=>'YII_ENV',
    //'env'=>null,
    //'debugVar'=>'YII_DEBUG',
    //'debug'=>null,
]);

// Yii
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(__DIR__ . '/../../common/config/bootstrap.php');


$config = \yii\helpers\ArrayHelper::merge(
// Common
    require(__DIR__ . '/../../common/config/base.php'),
    require(__DIR__ . '/../../common/config/base-local.php'),
    require(__DIR__ . '/../../common/config/web.php'),
    require(__DIR__ . '/../../common/config/web-local.php'),
    require(__DIR__ . '/../config/base.php'),
    require(__DIR__ . '/../config/web.php'),
    require(__DIR__ . '/../config/web-local.php')
);

(new yii\web\Application($config))->run();
