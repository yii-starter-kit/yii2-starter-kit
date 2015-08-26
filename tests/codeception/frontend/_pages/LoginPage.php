<?php

namespace tests\codeception\frontend\_pages;

use yii\codeception\BasePage;

/**
 * Represents loging page
 */
class LoginPage extends BasePage
{
    public $route = 'user/sign-in/login';

    /**
     * @param string $identity
     * @param string $password
     */
    public function login($identity, $password)
    {
        $this->actor->fillField('input[name="LoginForm[identity]"]', $identity);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
