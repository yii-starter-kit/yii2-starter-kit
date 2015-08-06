<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

$cache = [
    'class' => 'yii\caching\FileCache',
    'cachePath' => '@frontend/runtime/cache'
];

if (YII_ENV_DEV) {
    $cache = [
        'class' => 'yii\caching\DummyCache'
    ];
}

return $cache;
