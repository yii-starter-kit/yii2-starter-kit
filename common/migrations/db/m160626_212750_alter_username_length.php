<?php

require(Yii::getAlias('@dektrium/user/migrations/m141222_135246_alter_username_length.php'));

class m160626_212750_alter_username_length extends m141222_135246_alter_username_length
{
    public function down()
    {
        $this->alterColumn('{{%user}}', 'username', Schema::TYPE_STRING . '(32)');
    }
}