<?php

namespace tests\codeception\common\fixtures;
use yii\test\ActiveFixture;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Article';
    public $depends = [
        'tests\codeception\common\fixtures\ArticleCategoryFixture',
        'tests\codeception\common\fixtures\UserFixture',
    ];
}
