<?php
// Environment
require(__DIR__ . '/../../environments/Environment.php');
$environment = new Environment([
    //'envVar'=>'$environment->getEnv()',
    //'env'=>null,
    //'debugVar'=>'YII_DEBUG',
    //'debug'=>null,
]);

// Composer
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(__DIR__ . '/../../environments/'.$environment->getEnv().'/bootstrap.php');
if(file_exists(__DIR__ . '/../../environments/'.$environment->getEnv().'/bootstrap-local.php')){
    require(__DIR__ . '/../../environments/'.$environment->getEnv().'/bootstrap-local.php');
} else {
    throw new \Exception('You\'ve probably forgot to init application');
}

$config = \yii\helpers\ArrayHelper::merge(
    // Common
    require(__DIR__ . '/../../common/config/base.php'),
    require(__DIR__ . '/../../common/config/web.php'),
    require(__DIR__ . '/../config/web.php'),
    // Environment specific
    require(__DIR__ . '/../../environments/'.$environment->getEnv().'/common/config/base.php'),
    require(__DIR__ . '/../../environments/'.$environment->getEnv().'/common/config/web.php'),
    require(__DIR__ . '/../../environments/'.$environment->getEnv().'/frontend/config/web.php')
);

(new yii\web\Application($config))->run();
