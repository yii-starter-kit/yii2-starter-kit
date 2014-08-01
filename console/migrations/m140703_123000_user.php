<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123000_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'picture' => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',

            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'username'=>'webmaster',
            'email'=>'webmaster@example.com',
            'password_hash'=>Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'auth_key'=>Yii::$app->getSecurity()->generateRandomKey(),
            'role'=>\app\models\User::ROLE_ADMINISTRATOR,
            'status'=>\app\models\User::STATUS_ACTIVE,
            'created_at'=>new \yii\db\Expression('NOW()'),
            'updated_at'=>new \yii\db\Expression('NOW()')
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
