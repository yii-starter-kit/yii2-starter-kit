<?php
$config = require(dirname(dirname(__DIR__)) . '/config/frontend/functional.php');
new yii\web\Application($config);