<?php
// Setting environment
if(isset($_SERVER['YII_ENV'])){
    defined('YII_ENV') or define('YII_ENV', $_SERVER['YII_ENV']);
} else {
    defined('YII_ENV') or define('YII_ENV', 'local');
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

$config = \yii\helpers\ArrayHelper::merge(
    require(dirname(__DIR__).'/../common/config/web.php'),
    require(dirname(__DIR__).'/config/web.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/common/config/web.php'),
    require(dirname(__DIR__) . '/../environments/'.YII_ENV.'/backend/config/web.php')
);
(new yii\web\Application($config))->run();
