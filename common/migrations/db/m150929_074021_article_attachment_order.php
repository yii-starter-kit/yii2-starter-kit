<?php

use yii\db\Migration;

class m150929_074021_article_attachment_order extends Migration
{
    /**
     * @return bool|void
     */
    public function up()
    {
        $this->addColumn('{{%article_attachment}}', 'order', $this->integer());
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropColumn('{{%article_attachment}}', 'order');
    }
}
