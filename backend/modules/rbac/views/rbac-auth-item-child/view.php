<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItemChild */

$this->title = $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Child Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-item-child-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'parent' => $model->parent, 'child' => $model->child], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'parent' => $model->parent, 'child' => $model->child], [
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
                    'parent',
                    'child',
                ],
            ]) ?>

        </div>
    </div>
</div>
