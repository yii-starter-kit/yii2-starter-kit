<?php
// Setting environment
if(isset($_SERVER['YII_ENV'])){
    defined('YII_ENV') or define('YII_ENV', $_SERVER['YII_ENV']);
} else {
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

// Debug preparations
defined('YII_DEBUG') or define('YII_DEBUG', YII_ENV != 'prod');
defined('YII_ENV_DEV') or define('YII_ENV_DEV', YII_ENV != 'prod');

if(YII_DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Starting Application
require(dirname(__DIR__) . '/../vendor/autoload.php');
require(dirname(__DIR__) . '/../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/bootstrap.php');
if(file_exists(dirname(__DIR__) . '/../environments/'.YII_ENV.'/bootstrap-local.php')){
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/bootstrap-local.php');
} else {
    throw new \Exception('You\'ve probably forgot to init application');
}


$config = \yii\helpers\ArrayHelper::merge(
    // Common
    require(dirname(__DIR__) . '/../common/config/base.php'),
    require(dirname(__DIR__).'/../common/config/web.php'),
    require(dirname(__DIR__).'/config/web.php'),
    // Environment specific
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/common/config/base.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/common/config/base-local.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/common/config/web.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/common/config/web-local.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/frontend/config/web.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/frontend/config/web-local.php')
);

(new yii\web\Application($config))->run();
