<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'light-blue lighten-1',
            'role' => 'navigation'
        ],
    ]); ?>
    <?php echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => Yii::t('frontend', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('frontend', 'About'), 'url' => ['/page/view', 'slug' => 'about']],
        ['label' => Yii::t('frontend', 'Articles'), 'url' => ['/article/index']],
        ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']],
        ['label' => Yii::t('frontend', 'Signup'), 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
        ['label' => Yii::t('frontend', 'Login'), 'url' => ['/user/security/login'], 'visible' => Yii::$app->user->isGuest],
        [
            'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
            'visible' => !Yii::$app->user->isGuest,
            'items' => [
                [
                    'label' => Yii::t('frontend', 'Settings'),
                    'url' => ['/user/settings/profile']
                ],
                [
                    'label' => Yii::t('frontend', 'Backend'),
                    'url' => Yii::getAlias('@backendUrl'),
                    'visible' => Yii::$app->user->can('manager')
                ],
                [
                    'label' => Yii::t('frontend', 'Logout'),
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            ]
        ],
        [
            'label' => Yii::t('frontend', 'Language'),
            'items' => array_map(function ($code) {
                return [
                    'label' => Yii::$app->params['availableLocales'][$code],
                    'url' => ['/site/set-locale', 'locale' => $code],
                    'active' => Yii::$app->language === $code
                ];
            }, array_keys(Yii::$app->params['availableLocales']))
        ]
    ]
]); ?>
    <?php NavBar::end(); ?>
