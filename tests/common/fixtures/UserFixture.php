<?php

namespace tests\common\fixtures;

use common\models\User;
use yii\test\ActiveFixture;

/**
 * User fixture
 */
class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}
