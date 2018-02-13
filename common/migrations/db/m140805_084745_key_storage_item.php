<?php

use yii\db\Migration;

class m140805_084745_key_storage_item extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%key_storage_item}}', [
            'key' => $this->string(128)->notNull(),
            'value' => $this->text()->notNull(),
            'comment' => $this->text(),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer()
        ]);

        $this->addPrimaryKey('pk_key_storage_item_key', '{{%key_storage_item}}', 'key');
        $this->createIndex('idx_key_storage_item_key', '{{%key_storage_item}}', 'key', true);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('{{%key_storage_item}}');
    }
}
