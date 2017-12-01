<?php
/**
 * Application configuration for frontend functional tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/base.php'),
    require(YII_APP_BASE_PATH . '/common/config/web.php'),
    require(YII_APP_BASE_PATH . '/backend/config/base.php'),
    require(YII_APP_BASE_PATH . '/backend/config/web.php'),
    require(__DIR__ . '/../base.php'),
    require(__DIR__ . '/../common/functional.php'),
    [
        'components' => [
            'assetManager' => [
                'basePath' => YII_APP_BASE_PATH . '/frontend/web/assets'
            ],
        ]
    ]
);
