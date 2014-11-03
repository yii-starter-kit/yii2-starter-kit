<?php
Yii::setAlias('@base', realpath(dirname(__DIR__).'/../'));

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', realpath(dirname(__DIR__) . '/../frontend'));
Yii::setAlias('@backend', realpath(dirname(__DIR__) . '/../backend'));
Yii::setAlias('@console', realpath(dirname(__DIR__) . '/../console'));
Yii::setAlias('@storage', realpath(dirname(__DIR__) . '/../storage'));

Yii::setAlias('@tests', dirname(__DIR__) . '/../tests');
