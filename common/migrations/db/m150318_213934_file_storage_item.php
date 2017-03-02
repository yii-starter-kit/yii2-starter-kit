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
            'id' => $this->primaryKey(),
            'component' => $this->string()->notNull(),
            'base_url' => $this->string(1024)->notNull(),
            'path' => $this->string(1024)->notNull(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'upload_ip' => $this->string(15),
            'created_at' => $this->integer()->notNull()
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%file_storage_item}}');
    }
}
