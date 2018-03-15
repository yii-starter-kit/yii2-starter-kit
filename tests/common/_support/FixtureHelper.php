<?php

namespace tests\common\_support;

use Codeception\Module;
use tests\common\fixtures\ArticleAttachmentFixture;
use tests\common\fixtures\ArticleCategoryFixture;
use tests\common\fixtures\ArticleFixture;
use tests\common\fixtures\PageFixture;
use tests\common\fixtures\RbacAuthAssignmentFixture;
use tests\common\fixtures\RbacAuthItemChildFixture;
use tests\common\fixtures\RbacAuthItemFixture;
use tests\common\fixtures\RbacAuthRuleFixture;
use tests\common\fixtures\UserFixture;
use tests\common\fixtures\UserProfileFixture;
use tests\common\fixtures\WidgetCarouselFixture;
use tests\common\fixtures\WidgetCarouselItemFixture;
use tests\common\fixtures\WidgetMenuFixture;
use tests\common\fixtures\WidgetTextFixture;
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
        $this->initFixtures();
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
                'class' => ArticleFixture::class,
                'dataFile' => '@tests/common/fixtures/data/article.php',
            ],
            'article_category' => [
                'class' => ArticleCategoryFixture::class,
                'dataFile' => '@tests/common/fixtures/data/article_category.php',
            ],
            'article_attachment' => [
                'class' => ArticleAttachmentFixture::class,
                'dataFile' => '@tests/common/fixtures/data/article_attachment.php',
            ],
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => '@tests/common/fixtures/data/user.php',
            ],
            'user_profile' => [
                'class' => UserProfileFixture::class,
                'dataFile' => '@tests/common/fixtures/data/user_profile.php',
            ],
            'rbac_auth_rule' => [
                'class' => RbacAuthRuleFixture::class,
                'dataFile' => '@tests/common/fixtures/data/rbac_auth_rule.php',
            ],
            'rbac_auth_item' => [
                'class' => RbacAuthItemFixture::class,
                'dataFile' => '@tests/common/fixtures/data/rbac_auth_item.php',
            ],
            'rbac_auth_item_child' => [
                'class' => RbacAuthItemChildFixture::class,
                'dataFile' => '@tests/common/fixtures/data/rbac_auth_item_child.php',
            ],
            'rbac_auth_assignment' => [
                'class' => RbacAuthAssignmentFixture::class,
                'dataFile' => '@tests/common/fixtures/data/rbac_auth_assignment.php',
            ],
            'page' => [
                'class' => PageFixture::class,
                'dataFile' => '@tests/common/fixtures/data/page.php',
            ],
            'widget_carousel' => [
                'class' => WidgetCarouselFixture::class,
                'dataFile' => '@tests/common/fixtures/data/widget_carousel.php',
            ],
            'widget_carousel_item' => [
                'class' => WidgetCarouselItemFixture::class,
                'dataFile' => '@tests/common/fixtures/data/widget_carousel_item.php',
            ],
            'widget_text' => [
                'class' => WidgetTextFixture::class,
                'dataFile' => '@tests/common/fixtures/data/widget_text.php',
            ],
            'widget_menu' => [
                'class' => WidgetMenuFixture::class,
                'dataFile' => '@tests/common/fixtures/data/widget_menu.php',
            ]
        ];
    }
}
