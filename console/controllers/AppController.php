<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AppController extends Controller
{
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
