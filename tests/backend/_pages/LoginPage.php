<?php

namespace tests\backend\_pages;

use tests\backend\AcceptanceTester;
use yii\helpers\Url;

/**
 * Represents login page
 */
class LoginPage
{
    /** @var string */
    public $route = '/sign-in/login';
    /** @var AcceptanceTester */
    protected $actor;

    /**
     * LoginPage constructor.
     * @param $actor
     */
    public function __construct($actor)
    {
        $this->actor = $actor;
        $this->actor->amOnPage(Url::to($this->route));
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
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
