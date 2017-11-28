<?php

namespace tests\frontend\_pages;

use tests\frontend\AcceptanceTester;
use yii\helpers\Url;

/**
 * Represents signup page
 */
class SignupPage
{
    /** @var string */
    public $route = '/user/sign-in/signup';
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
     * @return SignupPage
     */
    public static function openBy($actor)
    {
        return new self($actor);
    }

    /**
     * @param array $signupData
     */
    public function submit(array $signupData)
    {
        foreach ($signupData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="SignupForm[' . $field . ']"]', $value);
        }
        $this->actor->click('signup-button');
    }
}
