<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_100207_user_drop_password_reset_token extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%user}}', 'password_reset_token');
    }

    public function down()
    {
        $this->addColumn('{{%user}}', 'password_reset_token', $this->string());
    }
}
