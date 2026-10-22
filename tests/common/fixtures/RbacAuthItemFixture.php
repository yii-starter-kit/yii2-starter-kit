<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;


class RbacAuthItemFixture extends ActiveFixture
{
    public $tableName = 'rbac_auth_item';
    public $depends = [
        RbacAuthRuleFixture::class,
    ];
}
