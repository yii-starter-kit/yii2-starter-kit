<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 20.10.2017
 * Time: 17:37
 */

namespace tests\common\fixtures;

use yii\test\ActiveFixture;


class RbacAuthItemFixture extends ActiveFixture
{
    public $tableName = 'rbac_auth_item';
    public $depends = [
        RbacAuthRuleFixture::class,
    ];
}
