<?php
/**
 * @var yii\web\View $this
 * @var string $content
 */

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Breadcrumbs;

$this->beginContent('@frontend/views/layouts/base.php')
?>
<div class="container">

    <?php echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?php if(Yii::$app->session->hasFlash('alert')):?>
        <?php echo \yii\bootstrap4\Alert::widget([
            'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ])?>
    <?php endif; ?>

    <!-- Example of your ads placing -->
    <?php echo \common\widgets\DbText::widget([
        'key' => 'ads-example'
    ]) ?>

    <?php echo $content ?>
</div>
<?php $this->endContent() ?>