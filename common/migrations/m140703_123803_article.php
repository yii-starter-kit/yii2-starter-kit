<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123803_article extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_category}}', [
            'id' => Schema::TYPE_PK,
            'slug' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT,
            'parent_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->createTable('{{%article}}', [
            'id' => Schema::TYPE_PK,
            'slug' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'view' => Schema::TYPE_STRING . '(255)',
            'category_id' => Schema::TYPE_INTEGER,
            'author_id' => Schema::TYPE_INTEGER,
            'updater_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'published_at' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->insert('{{%article_category}}', [
            'id' => 1,
            'slug' => 'news',
            'title' => 'News',
            'status' => \common\models\ArticleCategory::STATUS_ACTIVE,
            'created_at' => time()
        ]);

        $this->createIndex('idx_article_author_id', '{{%article}}', 'author_id');
        $this->addForeignKey('fk_article_author', '{{%article}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_article_updater_id', '{{%article}}', 'updater_id');
        $this->addForeignKey('fk_article_updater', '{{%article}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

        $this->createIndex('idx_category_id', '{{%article}}', 'category_id');
        $this->addForeignKey('fk_article_category', '{{%article}}', 'category_id', '{{%article_category}}', 'id');

        $this->createIndex('idx_parent_id', '{{%article_category}}', 'parent_id');
        $this->addForeignKey('fk_article_category_section', '{{%article_category}}', 'parent_id', '{{%article_category}}', 'id', 'cascade', 'cascade');

    }

    public function down()
    {
        $this->dropForeignKey('fk_article_author', '{{%article}}');
        $this->dropForeignKey('fk_article_updater', '{{%article}}');
        $this->dropForeignKey('fk_article_category', '{{%article}}');
        $this->dropForeignKey('fk_article_category_section', '{{%article_category}}');

        $this->dropTable('{{%article}}');
        $this->dropTable('{{%article_category}}');
    }
}
