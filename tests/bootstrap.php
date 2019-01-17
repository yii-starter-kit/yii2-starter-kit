<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

// Environment
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();
$dotenv->required('TEST_DB_DSN');
$dotenv->required('TEST_DB_USERNAME');
$dotenv->required('TEST_DB_PASSWORD');

// Set environment
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'test'));
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(__DIR__));