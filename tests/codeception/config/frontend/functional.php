<?php
$_SERVER['SCRIPT_FILENAME'] = FRONTEND_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = FRONTEND_ENTRY_URL;

/**
 * Application configuration for frontend functional tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/web.php'),
    require(YII_APP_BASE_PATH . '/frontend/config/web.php'),
    require(__DIR__ . '/../config.php'),
    require(__DIR__ . '/functional.php'),
    require(__DIR__ . '/config.php'),
    [
    ]
);
