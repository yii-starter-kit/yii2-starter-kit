<?php

use yii\db\Migration;

class m140709_173306_widget_menu extends Migration
{
    public function up()
    {
        $this->createTable('{{%widget_menu}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(32)->notNull(),
            'title' => $this->string()->notNull(),
            'items' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%widget_menu}}');
    }
}
