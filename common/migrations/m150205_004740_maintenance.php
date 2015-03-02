<?php

use yii\db\Schema;
use yii\db\Migration;

class m150205_004740_maintenance extends Migration
{
    public function up()
    {
        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 0,
            'comment' => 'Is frontend app in maintenance mode (1|0)'
        ]);
    }

    public function down()
    {
        $this->delete('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance'
        ]);
    }
}
