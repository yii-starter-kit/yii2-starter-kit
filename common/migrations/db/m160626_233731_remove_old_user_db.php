<?php

use yii\db\Migration;

class m160626_233731_remove_old_user_db extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_user', '{{%user_profile}}');
        $this->dropTable('{{%user_profile}}');
        
        $this->dropColumn('{{%user}}', 'access_token');
        $this->dropColumn('{{%user}}', 'oauth_client');
        $this->dropColumn('{{%user}}', 'oauth_client_user_id');
        $this->dropColumn('{{%user}}', 'status');
        $this->dropColumn('{{%user}}', 'logged_at');
        
        $this->dropTable('{{%user_token}}');
    }

    public function down()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('{{%user}}', 'access_token', $this->string(40)->notNull());
        $this->addColumn('{{%user}}', 'oauth_client', $this->string());
        $this->addColumn('{{%user}}', 'oauth_client_user_id', $this->string());
        $this->addColumn('{{%user}}', 'status', $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE));
        $this->addColumn('{{%user}}', 'logged_at', $this->integer());
        
        $this->createTable('{{%user_profile}}', [
            'user_id' => $this->primaryKey(),
            'firstname' => $this->string(),
            'middlename' => $this->string(),
            'lastname' => $this->string(),
            'avatar_path' => $this->string(),
            'avatar_base_url' => $this->string(),
            'locale' => $this->string(32)->notNull(),
            'gender' => $this->smallInteger(1)
        ], $tableOptions);

        $this->addForeignKey('fk_user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
        
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

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}