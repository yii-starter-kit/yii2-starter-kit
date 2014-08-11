<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123000_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',

            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id'=>1,
            'username'=>'webmaster',
            'email'=>'webmaster@example.com',
            'password_hash'=>Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'auth_key'=>Yii::$app->getSecurity()->generateRandomString(),
            'role'=>\common\models\User::ROLE_ADMINISTRATOR,
            'status'=>\common\models\User::STATUS_ACTIVE,
            'created_at'=>new \yii\db\Expression('NOW()'),
            'updated_at'=>new \yii\db\Expression('NOW()')
        ]);

        $this->createTable('{{%user_profile}}', [
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'firstname' => Schema::TYPE_STRING . '(255) ',
            'middlename' => Schema::TYPE_STRING . '(255) ',
            'lastname' => Schema::TYPE_STRING . '(255) ',
            'locale' => Schema::TYPE_STRING . '(32) NOT NULL',
            'gender' => Schema::TYPE_INTEGER . '(1) NOT NULL',
        ], $tableOptions);

        $this->insert('{{%user_profile}}', [
            'user_id'=>1,
            'locale'=>Yii::$app->sourceLanguage
        ]);
        $this->createIndex('idx_user_id', '{{%user_profile}}', 'user_id');
        $this->addForeignKey('fk_user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id');

    }

    public function down()
    {
        $this->dropForeignKey('fk_user', '{{%user_profile}}');
        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%user}}');

    }
}
