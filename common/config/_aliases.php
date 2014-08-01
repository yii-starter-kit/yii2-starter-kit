<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(__DIR__) . '/../frontend');
Yii::setAlias('@backend', dirname(__DIR__) . '/../backend');
Yii::setAlias('@console', dirname(__DIR__) . '/../console');
Yii::setAlias('@storage', dirname(__DIR__) . '/../storage');

Yii::setAlias('@frontendUrl', 'yii2-starter-kit.localhost');
Yii::setAlias('@backendUrl', 'backend.yii2-starter-kit.localhost');
Yii::setAlias('@storageUrl', 'storage.yii2-starter-kit.localhost');

Yii::setAlias('@bower', dirname(__DIR__) . '/assets/bower');
Yii::setAlias('@tests', dirname(__DIR__) . '/tests');
