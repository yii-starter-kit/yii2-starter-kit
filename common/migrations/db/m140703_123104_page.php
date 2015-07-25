<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123104_page extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%page}}', [
            'id' => Schema::primaryKey(),
            'slug' => Schema::string(2048)->notNull(),
            'title' => Schema::string(512)->notNull(),
            'body' => Schema::string()->notNull(),
            'view' => Schema::string(),
            'status' => Schema::smallInteger()->notNull(),
            'created_at' => Schema::integer(),
            'updated_at' => Schema::integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
