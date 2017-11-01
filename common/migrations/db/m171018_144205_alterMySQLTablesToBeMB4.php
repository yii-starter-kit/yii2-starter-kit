<?php

use yii\db\Migration;

/**
 *
 */
class m171018_144205_alterMySQLTablesToBeMB4 extends Migration
{
    /**
     *
     */
    public function safeUp()
    {
        echo __CLASS__ . ' ' . __METHOD__ . ' executing.\n';

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

            # Yii2 does not have a way to alter the database schema nor an `alterTable` AR method
            # As such AFAIK we have to do this migration using the SQL syntax

            return $this->execute("
# Category tables
ALTER TABLE
    article
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    article_attachment
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    article_category
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
# Category tables
ALTER TABLE
    file_storage_item
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
# i18n
ALTER TABLE
    i18n_message
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    i18n_source_message
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
# K/V stores
ALTER TABLE
    key_storage_item
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
# PAge table
ALTER TABLE
    page
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
#system tables
ALTER TABLE
    system_db_migration
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    system_log
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
# user tables
ALTER TABLE
    user
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    user_profile
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    user_token
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
# widget tables
ALTER TABLE
    widget_carousel
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    widget_carousel_item
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    widget_menu
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    widget_text
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

# rbac tables
# Remove FK's that will not convert properly
ALTER TABLE rbac_auth_assignment
  DROP FOREIGN KEY rbac_auth_assignment_ibfk_1;

ALTER TABLE rbac_auth_item
  DROP FOREIGN KEY rbac_auth_item_ibfk_1;

ALTER TABLE rbac_auth_item_child
  DROP FOREIGN KEY rbac_auth_item_child_ibfk_1;

ALTER TABLE rbac_auth_item_child
  DROP FOREIGN KEY rbac_auth_item_child_ibfk_2;

# Alter tables
ALTER TABLE
    rbac_auth_assignment
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    rbac_auth_item
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    rbac_auth_item_child
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
ALTER TABLE
    rbac_auth_rule
    CONVERT TO CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

# Re-create FKs
ALTER TABLE rbac_auth_assignment
    ADD FOREIGN KEY (item_name) REFERENCES rbac_auth_item(name);

ALTER TABLE rbac_auth_item
    ADD FOREIGN KEY (rule_name) REFERENCES rbac_auth_rule(name);

ALTER TABLE rbac_auth_item_child
    ADD FOREIGN KEY (parent) REFERENCES rbac_auth_item(name);

ALTER TABLE rbac_auth_item_child
    ADD FOREIGN KEY (child) REFERENCES rbac_auth_item(name);
            ", $tableOptions);
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
