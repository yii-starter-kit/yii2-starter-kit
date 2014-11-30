<?php

use yii\db\Schema;
use yii\db\Migration;

class m140709_173306_widget_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widget_menu}}', [
            'id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'items' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0'
        ], $tableOptions);

        $this->insert('{{%widget_menu}}', [
            'key'=>'frontend-index',
            'title'=>'Frontend index menu',
            'items'=>json_encode([
                [
                    'label'=>'Get started with Yii2',
                    'url'=>'http://www.yiiframework.com',
                    'options'=>['tag'=>'span'],
                    'template'=>'<a href="{url}" class="btn btn-lg btn-success">{label}</a>'
                ],
                [
                    'label'=>'Yii2 Starter Kit on GitHub',
                    'url'=>'https://github.com/trntv/yii2-starter-kit',
                    'options'=>['tag'=>'span'],
                    'template'=>'<a href="{url}" class="btn btn-lg btn-primary">{label}</a>'
                ],
                [
                    'label'=>'Find a bug?',
                    'url'=>'https://github.com/trntv/yii2-starter-kit/issues',
                    'options'=>['tag'=>'span'],
                    'template'=>'<a href="{url}" class="btn btn-lg btn-danger">{label}</a>'
                ]

            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'status'=>\common\models\WidgetMenu::STATUS_ACTIVE
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%widget_menu}}');
    }
}
