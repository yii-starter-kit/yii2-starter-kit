<?php
/**
 * Setup application environment
 */
Dotenv::load(__DIR__ . '/..');

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ?: 'prod');
