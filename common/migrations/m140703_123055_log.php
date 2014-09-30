<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123055_log extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_log}}', [
            'id' => Schema::TYPE_PK,
            'level' => Schema::TYPE_INTEGER,
            'category' => Schema::TYPE_STRING . '(255)',
            'log_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'prefix' => Schema::TYPE_TEXT,
            'message' => Schema::TYPE_TEXT
        ], $tableOptions);

        $this->createIndex('idx_log_level', '{{%system_log}}', 'level');
        $this->createIndex('idx_log_category', '{{%system_log}}', 'category');
    }

    public function down()
    {
        $this->dropTable('{{%system_log}}');
    }
}
