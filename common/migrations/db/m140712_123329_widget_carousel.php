<?php

use yii\db\Schema;
use yii\db\Migration;

class m140712_123329_widget_carousel extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widget_carousel}}', [
            'id' => Schema::primaryKey(),
            'key' => Schema::string()->notNull(),
            'status' => Schema::smallInteger()->default(0)
        ], $tableOptions);

        $this->createTable('{{%widget_carousel_item}}', [
            'id' => Schema::primaryKey(),
            'carousel_id' => Schema::integer()->notNull(),
            'base_url'=>Schema::string(1024),
            'path'=>Schema::string(1024),
            'type'=>Schema::string(),
            'url' => Schema::string(1024),
            'caption' => Schema::string(1024),
            'status' => Schema::smallInteger()->notNull()->default(0),
            'order' => Schema::integer()->default(0),
            'created_at' => Schema::integer(),
            'updated_at' => Schema::integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_item_carousel', '{{%widget_carousel_item}}', 'carousel_id', '{{%widget_carousel}}', 'id', 'cascade', 'cascade');

    }


    public function safeDown()
    {
        $this->dropForeignKey('fk_item_carousel', '{{%widget_carousel_item}}');
        $this->dropTable('{{%widget_carousel_item}}');
        $this->dropTable('{{%widget_carousel}}');
    }
}
