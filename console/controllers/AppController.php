<?php

namespace console\controllers;

use Yii;
use yii\base\Module;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AppController extends Controller
{
    private static $dbName;
    private static $db;

    /**
     * AppController constructor.
     * @param string $id
     * @param Module $module
     * @param array $config
     */
    public function __construct($id, Module $module, array $config = [])
    {
        self::$db = \Yii::$app->db;
        self::$dbName = $this->getDsnAttribute(self::$db->dsn, 'dbname');
        parent::__construct($id, $module, $config);
    }

    public $writablePaths = [
        '@common/runtime',
        '@frontend/runtime',
        '@frontend/web/assets',
        '@backend/runtime',
        '@backend/web/assets',
        '@storage/cache',
        '@storage/web/source'
    ];

    public $executablePaths = [
        '@backend/yii',
        '@frontend/yii',
        '@console/yii',
    ];

    public $generateKeysPaths = [
        '@base/.env'
    ];

    public function actionSetup()
    {
        $this->runAction('set-writable', ['interactive' => $this->interactive]);
        $this->runAction('set-executable', ['interactive' => $this->interactive]);
        $this->runAction('set-keys', ['interactive' => $this->interactive]);
        \Yii::$app->runAction('migrate/up', ['interactive' => $this->interactive]);
        \Yii::$app->runAction('rbac-migrate/up', ['interactive' => $this->interactive]);
    }


    /**
     * Truncates all tables in the database.
     */
    public function actionTruncate()
    {
        if ($this->confirm('This will truncate all tables of current database [' . self::$dbName . '].')) {
            self::$db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();
            $command = self::$db->createCommand("SHOW FULL TABLES WHERE TABLE_TYPE LIKE '%TABLE'");
            $res = $command->queryAll();
            foreach ($res as $row) {
                $rowName = 'Tables_in_' . self::$dbName;
                $this->stdout('Truncating table ' . $row[$rowName] . PHP_EOL, Console::FG_RED);
                self::$db->createCommand()->truncateTable($row[$rowName])->execute();
            }
            self::$db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();
        }
    }


    /**
     * Parses DNS string to find name of database
     * @param $name string, string to find
     * @param $dsn string, DNS string
     * @return null|string
     */
    private function getDsnAttribute($dsn, $name = 'dbname')
    {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }


    /**
     * Drops all tables in the database.
     */
    public function actionDrop()
    {
        if ($this->confirm('This will drop all tables of current database [' . self::$dbName . '].')) {
            self::$db->createCommand("SET foreign_key_checks = 0")->execute();
            $tables = self::$db->schema->getTableNames();
            foreach ($tables as $table) {
                $this->stdout('Dropping table ' . $table . PHP_EOL, Console::FG_RED);
                self::$db->createCommand()->dropTable($table)->execute();
            }
            self::$db->createCommand("SET foreign_key_checks = 1")->execute();
        }
    }


    public function actionSetWritable()
    {
        $this->setWritable($this->writablePaths);
    }

    public function actionSetExecutable()
    {
        $this->setExecutable($this->executablePaths);
    }

    public function actionSetKeys()
    {
        $this->setKeys($this->generateKeysPaths);
    }

    public function setWritable($paths)
    {
        foreach ($paths as $writable) {
            $writable = Yii::getAlias($writable);
            Console::output("Setting writable: {$writable}");
            @chmod($writable, 0777);
        }
    }

    public function setExecutable($paths)
    {
        foreach ($paths as $executable) {
            $executable = Yii::getAlias($executable);
            Console::output("Setting executable: {$executable}");
            @chmod($executable, 0755);
        }
    }

    public function setKeys($paths)
    {
        foreach ($paths as $file) {
            $file = Yii::getAlias($file);
            Console::output("Generating keys in {$file}");
            $content = file_get_contents($file);
            $content = preg_replace_callback('/<generated_key>/', function () {
                $length = 32;
                $bytes = openssl_random_pseudo_bytes(32, $cryptoStrong);
                return strtr(substr(base64_encode($bytes), 0, $length), '+/', '_-');
            }, $content);
            file_put_contents($file, $content);
        }
    }
}
