<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manager\models\search\SystemLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('manager', 'System Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-log-index">

    <p>
        <?= Html::a(Yii::t('manager', 'Clear'), ['clear'], ['class' => 'btn btn-danger', 'data-method'=>'post']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'level',
                'value'=>function($model){
                    return \yii\log\Logger::getLevelName($model->level);
                }
            ],
            'category',
            'log_time:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{delete}'
            ],
        ],
    ]); ?>

</div>
