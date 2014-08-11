<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => \Yii::t('frontend', 'Home'), 'url' => ['/site/index']],
                ['label' => \Yii::t('frontend', 'About'), 'url' => ['/page/view', 'alias'=>'about']],
                ['label' => \Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']],
                ['label' => \Yii::t('frontend', 'Signup'), 'url' => ['/user/signup'], 'visible'=>Yii::$app->user->isGuest],
                ['label' => \Yii::t('frontend', 'Login'), 'url' => ['/user/login'], 'visible'=>Yii::$app->user->isGuest],
                [
                    'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->username,
                    'visible'=>!Yii::$app->user->isGuest,
                    'items'=>[
                        [
                            'label' => \Yii::t('frontend', 'Profile'),
                            'url' => ['/user/profile']
                        ],
                        [
                            'label' => \Yii::t('frontend', 'Backend'),
                            'url' => Yii::getAlias('@backendUrl'),
                            'visible'=>Yii::$app->user->can('manager')
                        ],
                        [
                            'label' => \Yii::t('frontend', 'Logout'),
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']
                        ]
                    ]
                ],
            ],
        ]);
        NavBar::end();
        ?>

        <?= $content ?>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
