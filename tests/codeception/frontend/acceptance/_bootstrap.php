<?php
$config = require(dirname(dirname(__DIR__)) . '/config/frontend/acceptance.php');
new yii\web\Application($config);