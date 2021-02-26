<?php

namespace tests\frontend\acceptance;

use common\models\User;
use tests\frontend\_pages\SignupPage;

class SignupCest
{
    public function _before($event)
    {

    }

    public function _after($event)
    {
        User::deleteAll([
            'email' => 'tester.email@example.com',
            'username' => 'tester',
        ]);
    }

    public function _fail()
    {

    }

    /**
     * @param \tests\frontend\AcceptanceTester $I
     * @param \Codeception\Scenario $scenario
     */
    public function testUserSignup($I, $scenario)
    {
        $I->wantTo('ensure that signup works');

        $signupPage = SignupPage::openBy($I);
        $I->see('Sign up', 'h1');

        $I->amGoingTo('submit signup form with no data');

        $signupPage->submit([]);

        $I->expectTo('see validation errors');
        $I->see('Username cannot be blank.', '.alert.alert-danger');
        $I->see('E-mail cannot be blank.', '.alert.alert-danger');
        $I->see('Password cannot be blank.', '.alert.alert-danger');
        $I->see('Confirm Password cannot be blank.', '.alert.alert-danger');

        $I->amGoingTo('submit signup form with not correct email');
        $signupPage->submit([
            'username' => 'tester',
            'email' => 'tester.email',
            'password' => 'tester_password',
            'password_confirm' => 'tester_password',
        ]);

        $I->expectTo('see that email address is wrong');
        $I->dontSee('Username cannot be blank.', '.alert.alert-danger');
        $I->dontSee('Password cannot be blank.', '.alert.alert-danger');
        $I->dontSee('Confirm Password cannot be blank.', '.alert.alert-danger');
        $I->see('E-mail is not a valid email address.', '.alert.alert-danger');

        $I->amGoingTo('submit signup form with different passwords');
        $signupPage->submit([
            'username' => 'tester',
            'email' => 'tester.email@example.com',
            'password' => 'tester_password',
            'password_confirm' => 'wrong_password',
        ]);

        $I->expectTo('see that confirm password is wrong');
        $I->dontSee('Confirm Password cannot be blank.', '.alert.alert-danger');
        $I->dontSee('Password cannot be blank.', '.alert.alert-danger');
        $I->see('Confirm Password must be equal to "Password".', '.alert.alert-danger');

        $I->amGoingTo('submit signup form with correct email');
        $signupPage->submit([
            'username' => 'tester',
            'email' => 'tester.email@example.com',
            'password' => 'tester_password',
            'password_confirm' => 'tester_password',
        ]);
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }

        $I->expectTo('see that user logged in');
        $I->click("tester", "a");
        $I->see("Logout", "a");
    }
}
