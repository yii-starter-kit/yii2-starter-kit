<?php

use yii\db\Migration;

class m150205_004740_maintenance extends Migration
{
    public function up()
    {
        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 'disabled',
            'comment' => 'Set it to "true" to turn on maintenance mode'
        ]);
    }
}
