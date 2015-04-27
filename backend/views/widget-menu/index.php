<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\WidgetMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Widget Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-menu-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
            'modelClass' => 'Widget Menu',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'key',
            [
                'class'=>\common\grid\EnumColumn::className(),
                'attribute'=>'status',
                'enum'=>[
                    Yii::t('backend', 'Disabled'),
                    Yii::t('backend', 'Enabled')
                ],
            ],

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update} {delete}'],
        ],
    ]); ?>

</div>
