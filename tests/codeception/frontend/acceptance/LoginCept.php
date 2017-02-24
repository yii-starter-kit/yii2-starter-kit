<?php
use tests\codeception\frontend\_pages\LoginPage;
use tests\codeception\frontend\AcceptanceTester;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure login page works');

$loginPage = LoginPage::openBy($I);

$I->amGoingTo('submit login form with no data');
$loginPage->login('', '');
$I->expectTo('see validations errors');
$I->waitForText('Username or email cannot be blank.', 5, '#login-form > div.form-group.field-loginform-identity.required > div');
$I->waitForText('Password cannot be blank.', 5, '#login-form > div.form-group.field-loginform-password.required > div');

$I->amGoingTo('try to login with wrong credentials');
$I->expectTo('see validations errors');
$loginPage->login('admin', 'wrong');
$I->expectTo('see validations errors');
$I->waitForText('Incorrect username or password.', 5, '#login-form > div.form-group.field-loginform-password.required > div');

$I->amGoingTo('try to login with correct credentials');
$loginPage->login('webmaster', 'webmaster');
$I->expectTo('see that user is logged');
$I->waitForText('Logout', 5);
$I->dontSeeLink('Login');
$I->dontSeeLink('Signup');
