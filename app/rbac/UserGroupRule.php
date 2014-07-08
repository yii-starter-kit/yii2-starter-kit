<?php
namespace app\rbac;

use app\models\User;
use Yii;
use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            if ($item->name === 'administrator') {
                return $role == User::ROLE_ADMINISTRATOR;
            } elseif ($item->name === 'manager') {
                return $role == User::ROLE_ADMINISTRATOR || $role == User::ROLE_MANAGER ||$role == User::ROLE_USER;
            }
            elseif ($item->name === 'user') {
                return $role == User::ROLE_ADMINISTRATOR || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}

