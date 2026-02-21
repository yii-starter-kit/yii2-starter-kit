<?php declare(strict_types=1);


namespace tests\api\functional\base;


use tests\api\FunctionalTester;

class ApiCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveHttpHeader('X-Api-Key', 'Q1M6dPrGpzBWOnGf2NbkEMLntSCDhchuVKDGOUWC');
    }
}