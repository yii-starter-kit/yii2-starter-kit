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
            'id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . '(128) NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
            'comment' => Schema::TYPE_TEXT,
            'updated_at'=>Schema::TYPE_INTEGER,
            'created_at'=>Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->insert('{{%key_storage_item}}', [
            'key'=>'backend.theme-skin',
            'value'=>'skin-blue'
        ]);

        $this->createIndex('idx_key_storage_item_key', '{{%key_storage_item}}', 'key', true);
    }

    public function down()
    {
        $this->dropTable('{{%key_storage_item}}');
    }
}
