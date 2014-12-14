<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
$this->title = Yii::t('frontend', 'Articles')
?>
<div class="row">
    <div class="col-xs-12">
        <h2>
            <?= \yii\helpers\Html::a($model->title, ['view', 'id'=>$model->id]) ?>
        </h2>
    </div>
</div>