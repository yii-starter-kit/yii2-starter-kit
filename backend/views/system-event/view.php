<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SystemEvent */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'System Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-event-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'application',
            'category',
            'event',
            'name',
            'message',
            'created_at:datetime',
        ],
    ]) ?>

</div>
