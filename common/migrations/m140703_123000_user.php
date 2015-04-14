<?php

use yii\db\Schema;
use yii\db\Migration;

class m140703_123000_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(32)',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'oauth_client' => Schema::TYPE_STRING,
            'oauth_client_user_id' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT '.\common\models\User::STATUS_ACTIVE,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'logged_at' => Schema::TYPE_INTEGER
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id'=>1,
            'username'=>'webmaster',
            'email'=>'webmaster@example.com',
            'password_hash'=>Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'auth_key'=>Yii::$app->getSecurity()->generateRandomString(),
            'status'=>\common\models\User::STATUS_ACTIVE,
            'created_at'=>time(),
            'updated_at'=>time()
        ]);
        $this->insert('{{%user}}', [
            'id'=>2,
            'username'=>'manager',
            'email'=>'manager@example.com',
            'password_hash'=>Yii::$app->getSecurity()->generatePasswordHash('manager'),
            'auth_key'=>Yii::$app->getSecurity()->generateRandomString(),
            'status'=>\common\models\User::STATUS_ACTIVE,
            'created_at'=>time(),
            'updated_at'=>time()
        ]);
        $this->insert('{{%user}}', [
            'id'=>3,
            'username'=>'user',
            'email'=>'user@example.com',
            'password_hash'=>Yii::$app->getSecurity()->generatePasswordHash('user'),
            'auth_key'=>Yii::$app->getSecurity()->generateRandomString(),
            'status'=>\common\models\User::STATUS_ACTIVE,
            'created_at'=>time(),
            'updated_at'=>time()
        ]);

        $this->createTable('{{%user_profile}}', [
            'user_id' => Schema::TYPE_PK,
            'firstname' => Schema::TYPE_STRING . '(255) ',
            'middlename' => Schema::TYPE_STRING . '(255) ',
            'lastname' => Schema::TYPE_STRING . '(255) ',
            'avatar_path' => Schema::TYPE_STRING . '(255) ',
            'avatar_base_url' => Schema::TYPE_STRING . '(255) ',
            'locale' => Schema::TYPE_STRING . '(32) NOT NULL',
            'gender' => Schema::TYPE_INTEGER . '(1)'
        ], $tableOptions);

        $this->insert('{{%user_profile}}', [
            'user_id'=>1,
            'locale'=>Yii::$app->sourceLanguage,
            'firstname' => 'John',
            'lastname' => 'Doe'
        ]);
        $this->insert('{{%user_profile}}', [
            'user_id'=>2,
            'locale'=>Yii::$app->sourceLanguage
        ]);
        $this->insert('{{%user_profile}}', [
            'user_id'=>3,
            'locale'=>Yii::$app->sourceLanguage
        ]);
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
        }

    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_user', '{{%user_profile}}');
        }
        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%user}}');

    }
}
