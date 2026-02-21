<?php

namespace tests\frontend\acceptance;

use tests\frontend\AcceptanceTester;

class HomeCest
{
    public function ensureHomePageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure that home page works');
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('Yii2 Starter Kit');
        $I->seeLink('About');
        $I->click('About');
        $I->seeInCurrentUrl('/page/about');
    }
}
