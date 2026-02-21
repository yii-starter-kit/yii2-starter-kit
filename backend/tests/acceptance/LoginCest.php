<?php

namespace tests\backend\acceptance;

use tests\backend\_pages\LoginPage;

class LoginCest
{
    public function ensureLoginPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure login page works');

        $loginPage = LoginPage::openBy($I);

        sleep(5); // let's wait for the browser to fire-up
        $I->amGoingTo('submit login form with no data');
        $loginPage->login('', '');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.', '.alert.alert-danger');
        $I->see('Password cannot be blank.', '.alert.alert-danger');

        $I->amGoingTo('try to login with wrong credentials');
        $I->expectTo('see validations errors');
        $loginPage->login('admin', 'wrong');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.', '.alert.alert-danger');

        $I->amGoingTo('try to login with correct credentials');
        $loginPage->login('webmaster', 'webmaster');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }
        $I->expectTo('see that user is logged');
        $I->seeLink('Logout');

        /** Uncomment if using WebDriver
         * $I->click('Logout (erau)');
         * $I->dontSeeLink('Logout (erau)');
         * $I->seeLink('Login');
         */
    }
}
