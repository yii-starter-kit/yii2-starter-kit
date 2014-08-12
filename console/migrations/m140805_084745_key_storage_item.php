<?php

use yii\db\Schema;
use yii\db\Migration;

class m140805_084745_key_storage_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%key_storage_item}}', [
            'id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . '(128) NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%key_storage_item}}');
    }
}
