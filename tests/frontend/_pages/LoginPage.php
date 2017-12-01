<?php

namespace tests\frontend\_pages;

use tests\frontend\AcceptanceTester;
use yii\helpers\Url;

/**
 * Represents login page
 */
class LoginPage
{
    /** @var string */
    public $route = '/user/sign-in/login';
    /** @var AcceptanceTester */
    protected $actor;

    /**
     * LoginPage constructor.
     * @param $actor
     */
    public function __construct($actor)
    {
        $this->actor = $actor;
        $this->actor->amOnPage(Url::toRoute($this->route));
    }

    /**
     * @param $actor
     * @return LoginPage
     */
    public static function openBy($actor)
    {
        return new self($actor);
    }


    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $this->actor->fillField('input[name="LoginForm[identity]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
