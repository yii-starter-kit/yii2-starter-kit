<?php

use yii\db\Migration;

/**
 * Class m171018_144205_alterMySQLTablesToBeMB4
 */
class m171113_115830_alterCommonConfigIfMySQL extends Migration
{
    /**
     * If the DB engine is MySQL AND the specific two migrations ran successfully, change common/config/base.php db->charset to utf8mb4
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        echo __CLASS__ . ' ' . __METHOD__ . ' executing.\n';

        // do not proceed if not mysql
        if ($this->db->driverName !== 'mysql') {
            return true;
        }

        // do not proceed if specific migrations did not yet run
        $migrationCount = \Yii::$app->db->createCommand("
            SELECT *
            FROM `yii2-starter-kit`.`system_db_migration`
            WHERE `version` = 'm171018_141344_alterMySQLSchemaToBeMB4'
              OR `version`  = 'm171018_144205_alterMySQLTablesToBeMB4'
        ")->queryAll();
        if (count($migrationCount) !== 2) {
            return false;
        }

        // change value in .env and reload values
        // TODO probably a better way to do this as it is not limiting changes to the DB_CHAR key
        $path = './.env';
        if (file_exists($path)) {
            $file_contents = file_get_contents($path);
            $file_contents = str_replace("utf8","utf8mb4", $file_contents);
            file_put_contents($path, $file_contents);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        echo "m171113_115830_alterCommonConfigIfMySQL cannot be reverted.\n";

        return false;
    }
}
