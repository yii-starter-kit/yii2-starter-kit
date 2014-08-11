<?php

use yii\db\Schema;
use yii\db\Migration;

class m140805_084737_file_storage_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%file_storage_item}}', [
            'id' => Schema::TYPE_PK,
            'repository' => Schema::TYPE_STRING . '(32) NOT NULL',
            'category' => Schema::TYPE_STRING . '(128) NOT NULL',
            'url' => Schema::TYPE_STRING . '(2048) NOT NULL',
            'path' => Schema::TYPE_STRING . '(2048) NOT NULL',
            'mimeType' => Schema::TYPE_STRING . '(128) NOT NULL',
            'upload_ip' => Schema::TYPE_STRING . '(15) NOT NULL',
            'size' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%file_storage_item}}');
    }
}
