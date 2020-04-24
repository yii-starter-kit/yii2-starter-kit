<?php
use backend\assets\BackendAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var string $content
 */

$bundle = BackendAsset::register($this);

$this->params['body-class'] = $this->params['body-class'] ?? null;
$keyStorage = Yii::$app->keyStorage;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<?php echo Html::beginTag('body', [
    'class' => implode(' ', [
        ArrayHelper::getValue($this->params, 'body-class'),
        $keyStorage->get('adminlte.sidebar-fixed') ? 'layout-fixed' : null,
        $keyStorage->get('adminlte.sidebar-mini') ? 'sidebar-mini' : null,
        $keyStorage->get('adminlte.sidebar-collapsed') ? 'sidebar-collapse' : null,
        $keyStorage->get('adminlte.navbar-fixed') ? 'layout-navbar-fixed' : null,
        $keyStorage->get('adminlte.body-small-text') ? 'text-sm' : null,
        $keyStorage->get('adminlte.footer-fixed') ? 'layout-footer-fixed' : null,
    ]),
])?>
    <?php $this->beginBody() ?>
        <?php echo $content ?>
    <?php $this->endBody() ?>
<?php echo Html::endTag('body') ?>
</html>
<?php $this->endPage() ?>
