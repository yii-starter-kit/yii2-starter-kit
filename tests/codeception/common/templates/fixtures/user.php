<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$security = Yii::$app->getSecurity();

return [
    'username' => $faker->userName,
    'email' => $faker->email,
    'auth_key' => $security->generateRandomString(),
    'password_hash' => $security->generatePasswordHash('password_' . $index),
    'created_at' => time(),
    'updated_at' => time(),
];
