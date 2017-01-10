<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

use dektrium\user\models\User as BaseUser;
/**
 * Description of User
 *
 * @author HP
 */
class User extends BaseUser{
    
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_DELETED = 3;
    
    const ROLE_USER = "user";
    const ROLE_MANAGER = "manager";
    const ROLE_ADMINISTRATOR = "administrator";
    
    /**
     * @return string
     */
    public function getPublicIdentity()
    {
        if ($this->profile && $this->profile->name) {
            return $this->profile->name;
        }
        if ($this->username) {
            return $this->username;
        }
        return $this->email;
    }
}