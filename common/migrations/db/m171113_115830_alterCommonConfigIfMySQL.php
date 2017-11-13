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
        $migrationCount = \Yii::$app->db->createCommand('
            SELECT count(*)
            FROM `systen_migrations`
            WHERE `value` = `m171018_141344_alterMySQLSchemaToBeMB4`
              AND `value` = `m171018_144205_alterMySQLTablesToBeMB4`
        ')->execute();
        if ($migrationCount !== '2') {
            return false;
        }

        // change and save the .env value
        $dotenv = new Dotenv\Dotenv(__DIR__);
        $dotenv->overload();
        $dotenv['DB_CHARSET'] = 'utf8mb4';
        $dotenv->save();

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
