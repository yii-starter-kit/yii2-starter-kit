<?php

use yii\db\Schema;
use yii\db\Migration;

class m140709_173333_widget_text extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widget_text}}', [
            'id' => Schema::TYPE_PK,
            'alias' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->insert('{{%widget_text}}', [
            'alias'=>'backend_welcome',
            'title'=>'Welcome to backend',
            'body'=>'<p>Welcome to Yii2 Starter Kit Dashboard</p>',
            'status'=>1,
            'created_at'=> time(),
            'updated_at'=> time(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%widget_text}}');
    }
}
