<?php

use yii\db\Migration;

/**
 *
 */
class m171018_141344_alterMySQLSchemaToBeMB4 extends Migration
{
    /**
     *
     */
    public function safeUp()
    {
        echo __CLASS__ . ' ' . __METHOD__ . ' executing.\n';

        if ($this->db->driverName === 'mysql') {
            # If this command fails, do not fail the migration, but report a warning
            $schemaName = explode(';', getenv('DB_DSN'));
            $schemaName = end(explode('=', end($schemaName)));

            $newCharSet = "utf8mb4";
            $newCollate = "utf8mb4_unicode_ci";

            $changeSchemaSQL = "
SELECT *
FROM information_schema.SCHEMATA
WHERE DEFAULT_CHARACTER_SET_NAME = '$newCharSet'
AND DEFAULT_COLLATION_NAME = '$newCollate'
AND SCHEMA_NAME = '$schemaName';";

            $currentCharSet = $this->execute($changeSchemaSQL);

            if (!empty($currentCharSet)) {
                return true;
            }

            # Yii2 does not have a way to alter the database schema nor an `alterTable` AR method
            # As such AFAIK we have to do this migration using the MySQL syntax
            try {
                return $this->execute(
                    "ALTER DATABASE '" . $schemaName . "' CHARACTER SET = $newCharSet COLLATE = $newCollate;",
                    "CHARACTER SET utf8 COLLATE $newCollate ENGINE=InnoDB"
                );
            } catch (\Exception $e) {
                echo "\nWARNING: Schema could not be altered automatically. Please run the above query manually, then re-attempt migration(s).\n";
            }

        }

        return false;
    }

    /*
     *
     */
    public function safeDown()
    {
        echo "m171018_141344_alterMySQLToBeMB4 cannot be reverted.\n";

        return false;
    }
}
