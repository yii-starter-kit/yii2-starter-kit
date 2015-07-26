<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123803_article extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_category}}', [
            'id' => Schema::primaryKey(),
            'slug' => Schema::string(1024)->notNull(),
            'title' => Schema::string(512)->notNull(),
            'body' => Schema::text(),
            'parent_id' => Schema::integer(),
            'status' => Schema::smallInteger()->notNull()->default(0),
            'created_at' => Schema::integer(),
            'updated_at' => Schema::integer(),
        ], $tableOptions);

        $this->createTable('{{%article}}', [
            'id' => Schema::primaryKey(),
            'slug' => Schema::string(1024)->notNull(),
            'title' => Schema::string(512)->notNull(),
            'body' => Schema::text()->notNull(),
            'view' => Schema::string(),
            'category_id' => Schema::integer(),
            'thumbnail_base_url' => Schema::string(1024),
            'thumbnail_path' => Schema::string(1024),
            'author_id' => Schema::integer(),
            'updater_id' => Schema::integer(),
            'status' => Schema::smallInteger()->notNull()->default(0),
            'published_at' => Schema::integer(),
            'created_at' => Schema::integer(),
            'updated_at' => Schema::integer(),
        ], $tableOptions);

        $this->createTable('{{%article_attachment}}', [
            'id' => Schema::primaryKey(),
            'article_id' => Schema::integer()->notNull(),
            'path' => Schema::string()->notNull(),
            'base_url' => Schema::string(),
            'type' => Schema::string(),
            'size' => Schema::integer(),
            'name' => Schema::string(),
            'created_at' => Schema::integer()
        ]);

        $this->addForeignKey('fk_article_attachment_article', '{{%article_attachment}}', 'article_id', '{{%article}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_article_author', '{{%article}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_article_updater', '{{%article}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');
        $this->addForeignKey('fk_article_category', '{{%article}}', 'category_id', '{{%article_category}}', 'id');
        $this->addForeignKey('fk_article_category_section', '{{%article_category}}', 'parent_id', '{{%article_category}}', 'id', 'cascade', 'cascade');

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_article_attachment_article', '{{%article_attachment}}');
        $this->dropForeignKey('fk_article_author', '{{%article}}');
        $this->dropForeignKey('fk_article_updater', '{{%article}}');
        $this->dropForeignKey('fk_article_category', '{{%article}}');
        $this->dropForeignKey('fk_article_category_section', '{{%article_category}}');

        $this->dropTable('{{%article_attachment}}');
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%article_category}}');
    }
}
