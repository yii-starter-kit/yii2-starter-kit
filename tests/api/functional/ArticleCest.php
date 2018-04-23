<?php

namespace tests\api\functional;

use tests\api\functional\base\ApiCest;
use tests\api\FunctionalTester;

class ArticleCest extends ApiCest
{
    // tests
    public function testArticlesList(FunctionalTester $I)
    {
        $I->amOnPage('/v1/article');
        $I->see('Lorem ipsum');
    }

    public function testArticleView(FunctionalTester $I)
    {
        $I->amOnPage(['/v1/article', 'slug' => 'test-article-1']);
        $I->see('Lorem ipsum');
    }
}
