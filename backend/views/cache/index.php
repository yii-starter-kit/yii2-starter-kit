<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 * @var \yii\data\ArrayDataProvider $dataProvider
 */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Cache');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            'class',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{flush}',
                'buttons'=>[
                    'flush'=>function($url){
                        return \yii\helpers\Html::a('<i class="fa fa-refresh"></i>', $url, [
                            'title' => Yii::t('backend', 'Flush'),
                            'data-confirm' => Yii::t('backend', 'Are you sure you want to flush this cache?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

    <h4><?php echo \Yii::t('backend', 'Delete a value with the specified key from cache') ?></h4>
    <?php \yii\bootstrap\ActiveForm::begin([
        'layout'=>'inline'
    ]) ?>
        <?= Html::dropDownList('id', null, \yii\helpers\ArrayHelper::map($dataProvider->allModels, 'name', 'name'), ['class'=>'form-control']) ?>
        <?= Html::input('string', 'name', null, ['class'=>'form-control', 'placeholder'=>\Yii::t('backend', 'Key')]) ?>
        <?= Html::submitButton(Yii::t('backend', 'Flush'), ['class'=>'btn btn-danger']) ?>
    <?php \yii\bootstrap\ActiveForm::end() ?>



</div>
