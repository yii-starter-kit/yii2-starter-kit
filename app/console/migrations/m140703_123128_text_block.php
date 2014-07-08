<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123128_text_block extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%text_block}}', [
            'id' => Schema::TYPE_PK,
            'alias' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%text_block}}');
    }
}
