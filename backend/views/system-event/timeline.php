<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 * @var $model \common\models\SystemEvent
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
$this->title = Yii::t('backend', 'Application timeline');
$icons = [
    'user'=>'<i class="fa fa-user bg-blue"></i>'
];
?>
<?php \yii\widgets\Pjax::begin() ?>
<div class="row">
    <div class="col-md-12">
        <?php if($dataProvider->count > 0): ?>
            <ul class="timeline">
                <?php foreach($dataProvider->getModels() as $model): ?>
                    <?php if(!isset($date) || $date != Yii::$app->formatter->asDate($model->created_at)): ?>
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-blue">
                                <?= Yii::$app->formatter->asDate($model->created_at) ?>
                            </span>
                        </li>
                        <?php $date = Yii::$app->formatter->asDate($model->created_at) ?>
                    <?php endif; ?>
                    <li>
                        <!-- timeline icon -->
                        <?php echo \yii\helpers\ArrayHelper::getValue($icons, $model->category, '<i class="fa fa-envelope bg-blue"></i>') ?>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fa fa-clock-o"></i>
                                <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                            </span>

                            <h3 class="timeline-header">
                                <?php echo $model->name  ?>
                            </h3>

                            <div class="timeline-body">
                                <?php echo $model->getMessage() ?>
                            </div>

                            <div class="timeline-footer">
                                <a href="<?php echo \yii\helpers\Url::to(['view', 'id'=>$model->id]) ?>" class="btn btn-primary btn-xs" data-pjax="0">
                                    <?php echo Yii::t('backend', 'View') ?>
                                </a>
                                <a href="<?php echo \yii\helpers\Url::to(['timeline', 'SystemEventSearch[category]'=>$model->category, 'SystemEventSearch[event]'=>$model->event]) ?>" class="btn btn-success btn-xs">
                                    <?php echo $model->getFullEventName() ?>
                                </a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
                <li>
                    <i class="fa fa-clock-o">
                    </i>
                </li>
            </ul>
        <?php else: ?>
            <?php echo Yii::t('backend', 'No events found') ?>
        <?php endif; ?>
    </div>
    <div class="col-md-12 text-center">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
            'options' => ['class' => 'pagination']
        ]) ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end() ?>

