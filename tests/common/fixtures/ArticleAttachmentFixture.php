<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleAttachmentFixture extends ActiveFixture
{
    public $modelClass = 'common\models\ArticleAttachment';
    public $depends = [
        ArticleFixture::class
    ];
}
