<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @author Victor Gonzalez <victor@vgr.cl>
 * @var common\models\TimelineEvent $model
 */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
?>

<?php echo FAS::icon('user-slash', ['class' => 'bg-red']) ?>
<div class="timeline-item">
    <span class="time">
        <?php echo FAS::icon('clock').' '.Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

    <h3 class="timeline-header">
        <?php echo Yii::t('backend', '{identity} has been deleted', [
            'identity' => Html::tag('b', $model->data['public_identity']),
            'deleted_at' => Yii::$app->formatter->asDatetime($model->data['deleted_at'])
        ]) ?>
    </h3>
</div>