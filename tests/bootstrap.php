<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
// Composer
require_once( dirname(__DIR__) . '/vendor/autoload.php');

// Set environment
defined('YII_ENV') or define('YII_ENV', 'test');

// Environment
$dotenv = new \Dotenv\Dotenv( dirname(__DIR__) );
$dotenv->load();
$dotenv->required('TEST_DB_DSN');
$dotenv->required('TEST_DB_USERNAME');
$dotenv->required('TEST_DB_PASSWORD');