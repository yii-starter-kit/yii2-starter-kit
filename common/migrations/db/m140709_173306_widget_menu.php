<?php

use yii\db\Schema;
use yii\db\Migration;

class m140709_173306_widget_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widget_menu}}', [
            'id' => Schema::primaryKey(),
            'key' => Schema::string(32)->notNull(),
            'title' => Schema::string()->notNull(),
            'items' => Schema::text()->notNull(),
            'status' => Schema::smallInteger()->notNull()->default(0)
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%widget_menu}}');
    }
}
