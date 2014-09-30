<?php

use yii\db\Schema;
use yii\db\Migration;

class m140918_101328_widget_text_timestamp extends Migration
{
    public function up()
    {
        $this->addColumn('{{%widget_text}}', 'updated_at', Schema::TYPE_INTEGER);
        $this->addColumn('{{%widget_text}}', 'created_at', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('{{%widget_text}}', 'updated_at');
        $this->dropColumn('{{%widget_text}}', 'created_at');
    }
}
