<?php
use tests\codeception\frontend\_pages\LoginPage;
use tests\codeception\frontend\FunctionalTester;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure login page works');

$loginPage = LoginPage::openBy($I);

$I->amGoingTo('submit login form with no data');
$loginPage->login('', '');
$I->expectTo('see validations errors');
$I->canSeeElement('.field-loginform-identity.has-error');
$I->canSeeElement('.field-loginform-password.has-error');

$I->amGoingTo('try to login with correct credentials');
$loginPage->login('webmaster', 'webmaster');
$I->expectTo('see that user is logged');
$I->amOnPage(Yii::$app->homeUrl);