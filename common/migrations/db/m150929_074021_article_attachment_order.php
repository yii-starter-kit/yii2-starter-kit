<?php

use yii\db\Migration;

class m150929_074021_article_attachment_order extends Migration
{
    public function up()
    {
        $this->addColumn('{{%article_attachment}}', 'order', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%article_attachment}}', 'order');
    }
}
