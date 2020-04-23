<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\FileStorageItem
 */

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'File Storage Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="card">
    <div class="card-header">
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="card-body p-0">

        <?php echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'component',
                'base_url:url',
                'path',
                'type',
                'size',
                'name',
                'upload_ip',
                'created_at:datetime',
            ],
        ]) ?>
    </div>
</div>
