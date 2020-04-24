<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-item-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->name], [
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
                    'name',
                    'type',
                    'description:ntext',
                    'rule_name',
                    'data',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
