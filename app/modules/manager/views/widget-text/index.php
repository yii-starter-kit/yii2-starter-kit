<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manager\models\search\TextBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Text Blocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-block-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common', 'Create {modelClass}', [
    'modelClass' => 'Text Block',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias',
            'title',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}'
            ],
        ],
    ]); ?>

</div>
