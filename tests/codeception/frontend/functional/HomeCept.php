<?php
use tests\codeception\frontend\FunctionalTester;
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Yii2 Starter Kit');
$I->see('My Company');
