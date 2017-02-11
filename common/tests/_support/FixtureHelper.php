<?php

namespace tests\codeception\common\_support;

use common\fixtures\ArticleAttachmentFixture;
use common\fixtures\ArticleCategoryFixture;
use common\fixtures\ArticleFixture;
use common\fixtures\RbacAuthAssignmentFixture;
use common\fixtures\UserFixture;
use common\fixtures\UserProfileFixture;
use Codeception\Module;
use yii\test\FixtureTrait;

/**
 * This helper is used to populate database with needed fixtures before any tests should be run.
 * For example - populate database with demo login user that should be used in acceptance and functional tests.
 * All fixtures will be loaded before suite will be starded and unloaded after it.
 */
class FixtureHelper extends Module
{

    /**
     * Redeclare visibility because codeception includes all public methods that not starts from "_"
     * and not excluded by module settings, in actor class.
     */
    use FixtureTrait {
        loadFixtures as protected;
        fixtures as protected;
        globalFixtures as protected;
        unloadFixtures as protected;
        getFixtures as protected;
        getFixture as protected;
    }

    /**
     * Method called before any suite tests run. Loads User fixture login user
     * to use in acceptance and functional tests.
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $this->loadFixtures();
    }

    /**
     * Method is called after all suite tests run
     */
    public function _afterSuite()
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'article' => [
                'class' => ArticleFixture::className(),
                'dataFile' => '@common/fixtures/data/article.php',
            ],
            'article_category' => [
                'class' => ArticleCategoryFixture::className(),
                'dataFile' => 'common/fixtures/data/article_category.php',
            ],
            'article_attachment' => [
                'class' => ArticleAttachmentFixture::className(),
                'dataFile' => '@common/fixtures/data/article_attachment.php',
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@common/fixtures/data/user.php',
            ],
            'user_profile' => [
                'class' => UserProfileFixture::className(),
                'dataFile' => '@common/fixtures/data/user_profile.php',
            ],
            'rbac_auth_assignment' => [
                'class' => RbacAuthAssignmentFixture::className(),
                'dataFile' => '@common/fixtures/data/rbac_auth_assignment.php',
            ]
        ];
    }
}
