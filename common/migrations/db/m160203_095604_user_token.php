<?php

use yii\db\Migration;

class m160203_095604_user_token extends Migration
{
    /**
     * @return bool|void
     */
    public function up()
    {
        $this->createTable('{{%user_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'token' => $this->string(40)->notNull(),
            'expire_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('{{%user_token}}');
    }
}
