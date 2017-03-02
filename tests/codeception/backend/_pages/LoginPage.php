<?php

namespace tests\codeception\backend\_pages;

use yii\codeception\BasePage;

/**
 * Represents loging page
 */
class LoginPage extends BasePage
{
    public $route = 'sign-in/login';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
