<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
// Composer
require __DIR__ . '/../vendor/autoload.php';

// Set environment
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(__DIR__));

// Environment
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();
$dotenv->required('TEST_DB_DSN');
$dotenv->required('TEST_DB_USERNAME');
$dotenv->required('TEST_DB_PASSWORD');
