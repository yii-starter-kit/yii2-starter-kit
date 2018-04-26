<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use trntv\yii\datetime\DateTimeWidget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\content\models\search\ArticleSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('backend', 'Articles');

$this->params['breadcrumbs'][] = $this->title;

?>

<p>
    <?php echo Html::a(
        Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Article']),
        ['create'],
        ['class' => 'btn btn-success']) ?>
</p>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view table-responsive',
    ],
    'columns' => [
        [
            'attribute' => 'id',
            'options' => ['style' => 'width: 5%'],
        ],
        [
            'attribute' => 'slug',
            'options' => ['style' => 'width: 15%'],
        ],
        [
            'attribute' => 'title',
            'value' => function ($model) {
                return Html::a($model->title, ['update', 'id' => $model->id]);
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'category_id',
            'options' => ['style' => 'width: 10%'],
            'value' => function ($model) {
                return $model->category ? $model->category->title : null;
            },
            'filter' => ArrayHelper::map(ArticleCategory::find()->all(), 'id', 'title'),
        ],
        [
            'attribute' => 'created_by',
            'options' => ['style' => 'width: 10%'],
            'value' => function ($model) {
                return $model->author->username;
            },
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'options' => ['style' => 'width: 10%'],
            'enum' => Article::statuses(),
            'filter' => Article::statuses(),
        ],
        [
            'attribute' => 'published_at',
            'options' => ['style' => 'width: 10%'],
            'format' => 'datetime',
            'filter' => DateTimeWidget::widget([
                'model' => $searchModel,
                'attribute' => 'published_at',
                'phpDatetimeFormat' => 'dd.MM.yyyy',
                'momentDatetimeFormat' => 'DD.MM.YYYY',
                'clientEvents' => [
                    'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")'),
                ],
            ]),
        ],
        [
            'attribute' => 'created_at',
            'options' => ['style' => 'width: 10%'],
            'format' => 'datetime',
            'filter' => DateTimeWidget::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
                'phpDatetimeFormat' => 'dd.MM.yyyy',
                'momentDatetimeFormat' => 'DD.MM.YYYY',
                'clientEvents' => [
                    'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")'),
                ],
            ]),
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'options' => ['style' => 'width: 5%'],
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
