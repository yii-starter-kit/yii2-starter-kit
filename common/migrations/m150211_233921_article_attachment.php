<?php

use yii\db\Schema;
use yii\db\Migration;

class m150211_233921_article_attachment extends Migration
{
    public function up()
    {
        $this->createTable('{{%article_attachment}}', [
            'id' => Schema::TYPE_PK,
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'path' => Schema::TYPE_STRING . ' NOT NULL',
            'base_url' => Schema::TYPE_STRING,
            'type' => Schema::TYPE_STRING,
            'size' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_article_attachment_article',
            '{{%article_attachment}}',
            'article_id',
            '{{%article}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_article_attachment_article',
            '{{%article_attachment}}'
        );

        $this->dropTable('{{%article_attachment}}');
    }
}
