<?php

namespace tests\frontend;

class ArticleCest
{
    // tests
    public function testArticlesList(FunctionalTester $I)
    {
        $I->amOnPage(['article/index']);
        $I->canSee('Articles', 'h1');
        $I->canSee('Test Article 1', '.h3.card-title');
        $I->dontSee('Test Article 2', '.h3.card-title');
    }

    public function testArticleView(FunctionalTester $I)
    {
        $I->amOnPage(['article/view', 'slug' => 'test-article-1']);
        $I->canSee('Test Article 1', 'h1');
        $I->canSee('Lorem ipsum');
        $I->canSeeElement("//a[contains(@href,'attachment-download')]");
        $I->amOnPage(['article/view', 'slug' => 'unknown-article']);
        $I->canSee('404');
    }
}
