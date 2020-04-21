<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @author Victor Gonzalez <victor@vgr.cl>
 * @var \common\models\TimelineEvent $model
 */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
?>

<?php echo FAS::icon('user', ['class' => 'bg-red']) ?>
<div class="timeline-item">
    <span class="time">
        <?php echo FAS::icon('clock').' '.Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

    <h3 class="timeline-header">
        <?php echo Yii::t('backend', '{identity} has been deleted', [
            'identity' => $model->data['public_identity'],
            'created_at' => Yii::$app->formatter->asDatetime($model->data['created_at'])
        ]) ?>
    </h3>
</div>