<?php

use yii\db\Schema;
use yii\db\Migration;

class m140805_084812_system_event extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_event}}', [
            'id' => Schema::TYPE_PK,
            'application' => Schema::TYPE_STRING . '(64) NOT NULL',
            'category' => Schema::TYPE_STRING . '(64) NOT NULL',
            'event' => Schema::TYPE_STRING . '(64) NOT NULL',
            'data' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%system_event}}');
    }
}
