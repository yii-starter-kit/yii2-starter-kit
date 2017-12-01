<?php
/**
 * Application config for common unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/base.php'),
    require(dirname(__DIR__) . '/base.php'),
    [
        'id' => 'app-common',
        'basePath' => YII_APP_BASE_PATH
    ]
);
