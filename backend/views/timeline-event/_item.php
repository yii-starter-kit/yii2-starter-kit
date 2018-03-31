<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @var $model common\models\TimelineEvent
 */
?>
<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
        <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>
    <h3 class="timeline-header">
        <?= Yii::t('backend', 'You have new event') ?>
    </h3>

    <div class="timeline-body">
        <dl>
            <dt><?= Yii::t('backend', 'Application') ?>:</dt>
            <dd><?= $model->application ?></dd>

            <dt><?= Yii::t('backend', 'Category') ?>:</dt>
            <dd><?= $model->category ?></dd>

            <dt><?= Yii::t('backend', 'Event') ?>:</dt>
            <dd><?= $model->event ?></dd>

            <dt><?= Yii::t('backend', 'Date') ?>:</dt>
            <dd><?= Yii::$app->formatter->asDatetime($model->created_at) ?></dd>
        </dl>
    </div>
</div>