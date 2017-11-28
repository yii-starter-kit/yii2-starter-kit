<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Article';
    public $depends = [
        ArticleCategoryFixture::class,
        UserFixture::class,
    ];
}
