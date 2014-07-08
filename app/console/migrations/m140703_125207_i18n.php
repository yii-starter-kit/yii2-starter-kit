<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_125207_i18n extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%i18_source_message}}', [
            'id' => Schema::TYPE_PK,
            'category' => Schema::TYPE_STRING . '(32) NOT NULL',
            'message' => Schema::TYPE_TEXT . ' NOT NULL'
        ], $tableOptions);

        $this->createTable('{{%i18_message}}', [
            'id' => Schema::TYPE_INTEGER,
            'language' => Schema::TYPE_STRING . '(16) NOT NULL',
            'translation' => Schema::TYPE_TEXT . ' NOT NULL',
        ], $tableOptions);

        $this->addPrimaryKey('i18_message_pk', '{{%i18_message}}', ['id', 'language']);
        $this->addForeignKey('fk_message_source_message', '{{%i18_message}}', 'id', '{{%i18_source_message}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_message_source_message', '{{%i18_message}}');
        $this->dropTable('{{%i18_message}}');
        $this->dropTable('{{%i18_source_message}}');
    }
}
