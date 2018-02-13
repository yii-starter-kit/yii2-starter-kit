<?php

use yii\db\Migration;

class m140703_123104_page extends Migration
{
    /**
     * @return bool|void
     */
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(2048)->notNull(),
            'title' => $this->string(512)->notNull(),
            'body' => $this->text()->notNull(),
            'view' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
