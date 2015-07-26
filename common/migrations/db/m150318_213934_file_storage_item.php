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
            'id' => Schema::primaryKey(),
            'component' => Schema::string()->notNull(),
            'base_url' => Schema::string(1024)->notNull(),
            'path' => Schema::string(1024)->notNull(),
            'type' => Schema::string(),
            'size' => Schema::integer(),
            'name' => Schema::string(),
            'upload_ip' => Schema::string(15),
            'created_at' => Schema::integer()->notNull()
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%file_storage_item}}');
    }
}
