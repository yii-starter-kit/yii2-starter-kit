<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_092257_user_is_activated extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'is_activated', $this->boolean()->defaultValue(true));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'is_activated');
    }
}
