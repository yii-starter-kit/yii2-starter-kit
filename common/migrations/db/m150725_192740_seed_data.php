<?php

use common\models\User;
use yii\db\Migration;

class m150725_192740_seed_data extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'webmaster',
            'email' => 'webmaster@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 2,
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('manager'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 3,
            'username' => 'user',
            'email' => 'user@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('user'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id' => 1,
            'locale' => Yii::$app->sourceLanguage,
            'firstname' => 'John',
            'lastname' => 'Doe'
        ]);
        $this->insert('{{%user_profile}}', [
            'user_id' => 2,
            'locale' => Yii::$app->sourceLanguage
        ]);
        $this->insert('{{%user_profile}}', [
            'user_id' => 3,
            'locale' => Yii::$app->sourceLanguage
        ]);

        $this->insert('{{%page}}', [
            'slug' => 'about',
            'title' => 'About',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => \common\models\Page::STATUS_PUBLISHED,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%article_category}}', [
            'id' => 1,
            'slug' => 'news',
            'title' => 'News',
            'status' => \common\models\ArticleCategory::STATUS_ACTIVE,
            'created_at' => time()
        ]);

        $this->insert('{{%widget_menu}}', [
            'key' => 'frontend-index',
            'title' => 'Frontend index menu',
            'items' => json_encode([
                [
                    'label' => 'Get started with Yii2',
                    'url' => 'http://www.yiiframework.com',
                    'options' => ['tag' => 'span'],
                    'template' => '<a href="{url}" class="btn btn-lg btn-success">{label}</a>'
                ],
                [
                    'label' => 'Yii2 Starter Kit on GitHub',
                    'url' => 'https://github.com/yii2-starter-kit/yii2-starter-kit',
                    'options' => ['tag' => 'span'],
                    'template' => '<a href="{url}" class="btn btn-lg btn-primary">{label}</a>'
                ],
                [
                    'label' => 'Find a bug?',
                    'url' => 'https://github.com/yii2-starter-kit/yii2-starter-kit/issues',
                    'options' => ['tag' => 'span'],
                    'template' => '<a href="{url}" class="btn btn-lg btn-danger">{label}</a>'
                ]

            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'status' => \common\models\WidgetMenu::STATUS_ACTIVE
        ]);

        $this->insert('{{%widget_text}}', [
            'key' => 'backend_welcome',
            'title' => 'Welcome to backend',
            'body' => '<p>Welcome to Yii2 Starter Kit Dashboard</p>',
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%widget_text}}', [
            'key' => 'ads-example',
            'title' => 'Google Ads Example Block',
            'body' => '<div class="lead">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9505937224921657"
                     data-ad-slot="2264361777"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>',
            'status' => 0,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%widget_carousel}}', [
            'id' => 1,
            'key' => 'index',
            'status' => \common\models\WidgetCarousel::STATUS_ACTIVE
        ]);

        $this->insert('{{%widget_carousel_item}}', [
            'carousel_id' => 1,
            'base_url' => Yii::getAlias('@frontendUrl'),
            'path' => 'img/yii2-starter-kit.gif',
            'type' => 'image/gif',
            'url' => '/',
            'status' => 1
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.theme-skin',
            'value' => 'skin-blue',
            'comment' => 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow'
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-fixed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-boxed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-collapsed-sidebar',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 'disabled',
            'comment' => 'Set it to "enabled" to turn on maintenance mode'
        ]);

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->delete('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance'
        ]);

        $this->delete('{{%key_storage_item}}', [
            'key' => [
                'backend.theme-skin',
                'backend.layout-fixed',
                'backend.layout-boxed',
                'backend.layout-collapsed-sidebar',
            ],
        ]);

        $this->delete('{{%widget_carousel_item}}', [
            'carousel_id' => 1
        ]);

        $this->delete('{{%widget_carousel}}', [
            'id' => 1
        ]);

        $this->delete('{{%widget_text}}', [
            'key' => 'backend_welcome'
        ]);

        $this->delete('{{%widget_menu}}', [
            'key' => 'frontend-index'
        ]);

        $this->delete('{{%article_category}}', [
            'id' => 1
        ]);

        $this->delete('{{%page}}', [
            'slug' => 'about'
        ]);

        $this->delete('{{%user_profile}}', [
            'user_id' => [1, 2, 3]
        ]);

        $this->delete('{{%user}}', [
            'id' => [1, 2, 3]
        ]);
    }
}
