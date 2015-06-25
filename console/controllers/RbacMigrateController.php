<?php

namespace console\controllers;

use yii\console\controllers\MigrateController;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class RbacMigrateController extends MigrateController
{
    /**
     * Creates a new migration instance.
     * @param string $class the migration class name
     * @return \common\rbac\Migration the migration instance
     */
    protected function createMigration($class)
    {
        $file = $this->migrationPath . DIRECTORY_SEPARATOR . $class . '.php';
        require_once($file);

        return new $class();
    }
}
