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
            'url' => Schema::TYPE_STRING . '(2048) NOT NULL'
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
