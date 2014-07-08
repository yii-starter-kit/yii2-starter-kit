<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123803_article extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article}}', [
            'id' => Schema::TYPE_PK,
            'alias' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'published_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_user_id', '{{%article}}', 'user_id');
        $this->addForeignKey('fk_article_user', '{{%article}}', 'user_id', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_article_user', '{{%article}}');
        $this->dropTable('{{%article}}');
    }
}
