<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_195800_timeline_event extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%timeline_event}}', [
            'id' => Schema::TYPE_PK,
            'application' => Schema::TYPE_STRING . '(64) NOT NULL',
            'category' => Schema::TYPE_STRING . '(64) NOT NULL',
            'event' => Schema::TYPE_STRING . '(64) NOT NULL',
            'data' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);

        $this->createIndex('idx_created_at', '{{%timeline_event}}', 'created_at');

        $this->batchInsert(
            '{{%timeline_event}}',
            ['application', 'category', 'event', 'data', 'created_at'],
            [
                ['frontend', 'user', 'signup', json_encode(['publicIdentity' => 'webmaster', 'userId' => 1, 'created_at' => time()]), time()],
                ['frontend', 'user', 'signup', json_encode(['publicIdentity' => 'manager', 'userId' => 2, 'created_at' => time()]), time()],
                ['frontend', 'user', 'signup', json_encode(['publicIdentity' => 'user', 'userId' => 3, 'created_at' => time()]), time()]
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%timeline_event}}');
    }
}
