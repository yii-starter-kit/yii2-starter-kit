<?php

namespace tests\codeception\common\fixtures;

use common\models\KeyStorageItem;
use yii\test\ActiveFixture;

/**
 * User fixture
 */
class UserFixture extends ActiveFixture
{
    public $modelClass = KeyStorageItem::class;
}
