<?php
use backend\assets\BackendAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $content string */

$bundle = BackendAsset::register($this);

$this->params['body-class'] = array_key_exists('body-class', $this->params) ?
    $this->params['body-class']
    : null;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<?= Html::beginTag('body', [
    'class' => implode(' ', [
        ArrayHelper::getValue($this->params, 'body-class'),
        Yii::$app->keyStorage->get('backend.theme-skin', 'skin-blue'),
        Yii::$app->keyStorage->get('backend.layout-fixed') ? 'fixed' : null,
        Yii::$app->keyStorage->get('backend.layout-boxed') ? 'layout-boxed' : null,
        Yii::$app->keyStorage->get('backend.layout-collapsed-sidebar') ? 'sidebar-collapse' : null,
    ])
])?>
    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
<?= Html::endTag('body') ?>
</html>
<?php $this->endPage() ?>