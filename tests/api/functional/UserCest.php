<?php

namespace tests\api\functional;

use tests\api\functional\base\ApiCest;
use tests\api\FunctionalTester;

class UserCest extends ApiCest
{
    // tests
    public function testUser(FunctionalTester $I)
    {
        $I->amOnPage('/v1/user');
        $I->see('user');
    }

    public function testUserAccess(FunctionalTester $I)
    {
        $I->deleteHeader('X-Api-Key');
        $I->amOnPage('/v1/user');
        $I->seeResponseCodeIs(401);
    }
}
