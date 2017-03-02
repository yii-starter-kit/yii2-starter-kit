<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class RbacAuthAssignmentFixture extends ActiveFixture
{
    public $tableName = 'rbac_auth_assignment';
    public $depends = [
        'tests\codeception\common\fixtures\UserFixture'
    ];
}
