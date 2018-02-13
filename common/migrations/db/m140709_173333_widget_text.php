<?php

use yii\db\Migration;

class m140709_173333_widget_text extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%widget_text}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('idx_widget_text_key', '{{%widget_text}}', 'key');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('{{%widget_text}}');
    }
}
