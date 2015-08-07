<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
$this->title = Yii::t('backend', 'Application settings');
?>
<div class="box">
    <div class="box-body">
        <?php echo \common\components\keyStorage\FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap\ActiveForm',
            'submitText' => Yii::t('backend', 'Save'),
            'submitOptions' => ['class' => 'btn btn-primary']
        ]); ?>
    </div>
</div>

