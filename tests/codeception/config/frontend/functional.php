<?php
$_SERVER['SCRIPT_FILENAME'] = BACKEND_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = BACKEND_ENTRY_URL;

/**
 * Application configuration for frontend functional tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/base.php'),
    require(YII_APP_BASE_PATH . '/common/config/web.php'),
    require(YII_APP_BASE_PATH . '/frontend/config/base.php'),
    require(YII_APP_BASE_PATH . '/frontend/config/web.php'),
    require(dirname(__DIR__) . '/base.php'),
    require(dirname(__DIR__) . '/web.php'),
    require(dirname(__DIR__) . '/functional.php')
);