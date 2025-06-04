<?php
/**
 * Require helpers
 */
require_once(__DIR__ . '/helpers.php');

/**
 * Load application environment from .env file
 */
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/**
 * Init application constants
 */
defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));
