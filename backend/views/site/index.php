<?php
/* @var $this yii\web\View */
$this->title = Yii::t('backend', 'Backend');
?>
<div id="site-index">
    <?= \common\components\widgets\text\TextWidget::widget([
        'alias'=>'backend_welcome'
    ]) ?>
</div>

