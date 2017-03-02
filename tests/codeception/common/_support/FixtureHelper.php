<?php

namespace tests\codeception\common\_support;

use tests\codeception\common\fixtures\ArticleAttachmentFixture;
use tests\codeception\common\fixtures\ArticleCategoryFixture;
use tests\codeception\common\fixtures\ArticleFixture;
use tests\codeception\common\fixtures\RbacAuthAssignmentFixture;
use tests\codeception\common\fixtures\UserFixture;
use Codeception\Module;
use tests\codeception\common\fixtures\UserProfileFixture;
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
                'dataFile' => '@tests/codeception/common/fixtures/data/article.php',
            ],
            'article_category' => [
                'class' => ArticleCategoryFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/article_category.php',
            ],
            'article_attachment' => [
                'class' => ArticleAttachmentFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/article_attachment.php',
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user.php',
            ],
            'user_profile' => [
                'class' => UserProfileFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user_profile.php',
            ],
            'rbac_auth_assignment' => [
                'class' => RbacAuthAssignmentFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/rbac_auth_assignment.php',
            ]
        ];
    }
}
