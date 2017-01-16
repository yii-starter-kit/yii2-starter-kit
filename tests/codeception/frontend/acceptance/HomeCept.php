<?php
use tests\codeception\frontend\AcceptanceTester;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->waitForText('Yii2 Starter Kit', 5);
$I->seeLink('About');
$I->click('About');
$I->amOnPage('/page/about');
