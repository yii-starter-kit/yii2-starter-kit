<?php

use backend\modules\translation\models\Source;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/**
 * @var $this               yii\web\View
 * @var $searchModel        backend\modules\translation\models\search\SourceSearch
 * @var $dataProvider       yii\data\ActiveDataProvider
 * @var $model              \common\base\MultiModel
 * @var $languages          array
 */

$this->title = Yii::t('backend', 'Translation');
$this->params['breadcrumbs'][] = $this->title;

?>

    <div class="box box-success collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Source Message']) ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <?php echo $this->render('_form', [
                'model' => $model,
                'languages' => $languages,
            ]) ?>
        </div>
    </div>

<?php

$translationColumns = [];
foreach ($languages as $language => $name) {
    $translationColumns[] = [
        'attribute' => $language,
        'header' => $name,
        'value' => $language . '.translation',
    ];
}


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view table-responsive',
    ],
    'columns' => ArrayHelper::merge([
        [
            'attribute' => 'id',
            'options' => ['style' => 'width: 5%'],
        ],
        [
            'attribute' => 'category',
            'options' => ['style' => 'width: 10%'],
            'filter' => ArrayHelper::map(Source::find()->select('category')->distinct()->all(), 'category', 'category'),
        ],
        'message:ntext',
        [
            'class' => \common\widgets\ActionColumn::class,
            'options' => ['style' => 'width: 5%'],
            'template' => '{update} {delete}',
        ],
    ], $translationColumns),
]); ?>