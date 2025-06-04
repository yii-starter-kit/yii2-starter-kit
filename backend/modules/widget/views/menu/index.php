<?php

use common\grid\EnumColumn;
use common\models\WidgetMenu;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  \backend\modules\widget\models\search\MenuSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\WidgetMenu
 */

$this->title = Yii::t('backend', 'Widget Menus');

$this->params['breadcrumbs'][] = $this->title;

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>

<div class="card">
    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'columns' => [
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width: 5%'],
                ],
                [
                    'attribute' => 'key',
                    'options' => ['style' => 'width: 20%'],
                ],
                [
                    'attribute' => 'title',
                    'value' => function ($model) {
                        return Html::a($model->title, ['update', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => EnumColumn::class,
                    'attribute' => 'status',
                    'options' => ['style' => 'width: 10%'],
                    'enum' => WidgetMenu::statuses(),
                    'filter' => WidgetMenu::statuses(),
                ],
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'options' => ['style' => 'width: 5%'],
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>

