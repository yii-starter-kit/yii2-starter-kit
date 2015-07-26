<?php

use yii\db\Schema;
use yii\db\Migration;

class m140805_084745_key_storage_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';
        }

        $this->createTable('{{%key_storage_item}}', [
            'key' => Schema::string(128)->notNull(),
            'value' => Schema::text()->notNull(),
            'comment' => Schema::text(),
            'updated_at'=>Schema::integer(),
            'created_at'=>Schema::integer()
        ], $tableOptions);

        $this->addPrimaryKey('pk_key_storage_item_key', '{{%key_storage_item}}', 'key');
        $this->createIndex('idx_key_storage_item_key', '{{%key_storage_item}}', 'key', true);
    }

    public function down()
    {
        $this->dropTable('{{%key_storage_item}}');
    }
}
