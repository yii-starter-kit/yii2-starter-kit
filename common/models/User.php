<?php
/**
 * Created by PhpStorm.
 * User: gogl92
 * Date: 2/02/17
 * Time: 11:58 PM
 */

namespace common\models;
use common\models\query\UserQuery;
use dektrium\user\models\User as BaseUser;
use yii\web\IdentityInterface;

/**
 *
 * @property string $publicIdentity
 */
class User extends BaseUser implements IdentityInterface
{
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_DELETED = 3;
    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMINISTRATOR = 'administrator';
    const EVENT_AFTER_SIGNUP = 'afterSignup';
    const EVENT_AFTER_LOGIN = 'afterLogin';

    /**
     * @return UserQuery
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getPublicIdentity()
    {
        if ($this->profile && $this->profile->getFullName()) {
            return $this->profile->getFullname();
        }
        if ($this->username) {
            return $this->username;
        }
        return $this->email;
    }
}