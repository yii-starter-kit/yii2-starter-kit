<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Rbac Auth Item Children');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-item-child-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('frontend', 'Create Rbac Auth Item Child'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'parent',
            'child',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
