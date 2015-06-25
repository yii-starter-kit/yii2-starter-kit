<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_213934_file_storage_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%file_storage_item}}', [
            'id' => Schema::TYPE_PK,
            'component' => Schema::TYPE_STRING . '(255) NOT NULL',
            'base_url' => Schema::TYPE_STRING . '(512) NOT NULL',
            'path' => Schema::TYPE_STRING . '(512) NOT NULL',
            'type' => Schema::TYPE_STRING . '(128)',
            'size' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING . '(255)',
            'upload_ip' => Schema::TYPE_STRING . '(15)',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%file_storage_item}}');
    }
}
