<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class UserProfileFixture extends ActiveFixture
{
    public $modelClass = 'common\models\UserProfile';
    public $depends = [
        'common\fixtures\UserFixture'
    ];
}
