<?php
require(Yii::getAlias('@dektrium/user/migrations/m140209_132017_init.php'));
use yii\db\Schema;

/**
 * Handles the creation for table `users_module_table`.
 */
class m160626_193708_create_users_module_table extends m140209_132017_init {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn('{{%user}}', 'confirmation_token', Schema::TYPE_STRING . '(32)');
        $this->addColumn('{{%user}}', 'confirmation_sent_at', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'confirmed_at', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'unconfirmed_email', Schema::TYPE_STRING . '(255)');
        $this->addColumn('{{%user}}', 'recovery_token', Schema::TYPE_STRING . '(32)');
        $this->addColumn('{{%user}}', 'recovery_sent_at', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'blocked_at', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'registered_from', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'logged_in_from', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'logged_in_at', Schema::TYPE_INTEGER);
        
        $this->createIndex('user_unique_username', '{{%user}}', 'username', true);
        $this->createIndex('user_unique_email', '{{%user}}', 'email', true);
        $this->createIndex('user_confirmation', '{{%user}}', 'id, confirmation_token', true);
        $this->createIndex('user_recovery', '{{%user}}', 'id, recovery_token', true);
        
        $this->createTable('{{%profile}}', [
            'user_id' => Schema::TYPE_INTEGER . ' PRIMARY KEY',
            'name' => Schema::TYPE_STRING . '(255)',
            'public_email' => Schema::TYPE_STRING . '(255)',
            'gravatar_email' => Schema::TYPE_STRING . '(255)',
            'gravatar_id' => Schema::TYPE_STRING . '(32)',
            'location' => Schema::TYPE_STRING . '(255)',
            'website' => Schema::TYPE_STRING . '(255)',
            'bio' => Schema::TYPE_TEXT,
                ], $this->tableOptions);
        $this->addForeignKey('fk_user_profile', '{{%profile}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{%profile}}');
        
        $this->dropIndex('user_unique_email', '{{%user}}');
        $this->dropIndex('user_confirmation', '{{%user}}');
        $this->dropIndex('user_recovery', '{{%user}}');
        $this->dropIndex('user_unique_username', '{{%user}}');
        
        $this->dropColumn('{{%user}}', 'confirmation_token');
        $this->dropColumn('{{%user}}', 'confirmation_token');
        $this->dropColumn('{{%user}}', 'confirmation_sent_at');
        $this->dropColumn('{{%user}}', 'confirmed_at');
        $this->dropColumn('{{%user}}', 'unconfirmed_email');
        $this->dropColumn('{{%user}}', 'recovery_token');
        $this->dropColumn('{{%user}}', 'recovery_sent_at');
        $this->dropColumn('{{%user}}', 'blocked_at');
        $this->dropColumn('{{%user}}', 'registered_from');
        $this->dropColumn('{{%user}}', 'logged_in_from');
        $this->dropColumn('{{%user}}', 'logged_in_at');
    }

}