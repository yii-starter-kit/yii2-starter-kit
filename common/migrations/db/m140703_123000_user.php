<?php

use common\models\User;
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
            'id' => Schema::primaryKey(),
            'username' => Schema::string(32),
            'auth_key' => Schema::string(32)->notNull(),
            'password_hash' => Schema::string()->notNull(),
            'password_reset_token' => Schema::string(),
            'oauth_client' => Schema::string(),
            'oauth_client_user_id' => Schema::string(),
            'email' => Schema::string()->notNull(),
            'status' => Schema::smallInteger()->notNull()->default(User::STATUS_ACTIVE),
            'created_at' => Schema::integer(),
            'updated_at' => Schema::integer(),
            'logged_at' => Schema::integer()
        ], $tableOptions);

        $this->createTable('{{%user_profile}}', [
            'user_id' => Schema::primaryKey(),
            'firstname' => Schema::string(),
            'middlename' => Schema::string(),
            'lastname' => Schema::string(),
            'avatar_path' => Schema::string(),
            'avatar_base_url' => Schema::string(),
            'locale' => Schema::string(32)->notNull(),
            'gender' => Schema::smallInteger(1)
        ], $tableOptions);

        $this->addForeignKey('fk_user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');

    }

    public function down()
    {
        $this->dropForeignKey('fk_user', '{{%user_profile}}');
        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%user}}');

    }
}
