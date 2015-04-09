<?php

use yii\db\Schema;
use yii\db\Migration;

class m150408_211055_article_thumbnail extends Migration
{
    public function up()
    {
        $this->addColumn('{{%article}}', 'thumbnail_base_url', Schema::TYPE_STRING . '(1024)');
        $this->addColumn('{{%article}}', 'thumbnail_path', Schema::TYPE_STRING . '(1024)');
    }

    public function down()
    {
        $this->dropColumn('{{%article}}', 'thumbnail_base_url');
        $this->dropColumn('{{%article}}', 'thumbnail_path');
    }
}
