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
            'id' => Schema::TYPE_PK,
            'slug' => Schema::TYPE_STRING . '(2048) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'view' => Schema::TYPE_STRING . '(255)',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->insert('{{%page}}', [
            'slug'=>'about',
            'title'=>'About',
            'body'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status'=>\common\models\Page::STATUS_PUBLISHED,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
