<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class RbacAuthAssignmentFixture extends ActiveFixture
{
    public $tableName = 'rbac_auth_assignment';
    public $depends = [
        UserFixture::class,
        RbacAuthItemFixture::class,
    ];
}
