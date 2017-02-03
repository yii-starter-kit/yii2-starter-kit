<?php
/**
 * Created by PhpStorm.
 * User: gogl92
 * Date: 3/02/17
 * Time: 12:06 AM
 */

namespace common\models;

use dektrium\user\models\Profile as BaseProfile;

/* @property string $middlename
 * @property null|string $fullName
 * @property string $lastname
 */
class UserProfile extends BaseProfile
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->name || $this->lastname) {
            return implode(' ', [$this->name, $this->lastname]);
        }
        return null;
    }

}