<?php

use yii\db\Schema;
use yii\db\Migration;

class m140709_173333_widget_text extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widget_text}}', [
            'id' => Schema::primaryKey(),
            'key' => Schema::string()->notNull(),
            'title' => Schema::string()->notNull(),
            'body' => Schema::text()->notNull(),
            'status' => Schema::smallInteger(),
            'created_at' => Schema::integer(),
            'updated_at' => Schema::integer(),
        ], $tableOptions);

        $this->createIndex('idx_widget_text_key', '{{%widget_text}}', 'key');
    }

    public function down()
    {
        $this->dropTable('{{%widget_text}}');
    }
}
