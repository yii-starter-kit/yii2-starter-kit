<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;


class RbacAuthItemChildFixture extends ActiveFixture
{
    public $tableName = 'rbac_auth_item_child';
    public $depends = [
        RbacAuthItemFixture::class,
    ];
}
