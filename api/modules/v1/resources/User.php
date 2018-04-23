<?php

namespace api\modules\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class User extends \common\models\User
{
    public function fields()
    {
        return ['id', 'username', 'created_at'];
    }

    public function extraFields()
    {
        return ['userProfile'];
    }
}
