<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 *
 * @var yii\data\ArrayDataProvider $dataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

$this->title = Yii::t('backend', 'Cache');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card-deck">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo Yii::t('backend', 'Cache Components') ?></h3>
        </div>
        <div class="card-body">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'name',
                    'class',
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'template' => '{flush-cache}',
                        'buttons' => [
                            'flush-cache' => function ($url, $model) {
                                return \yii\helpers\Html::a(FAS::icon('eraser'). ' '. Yii::t('backend', 'Flush Cache'), $url, [
                                    'title' => Yii::t('backend', 'Flush'),
                                    'data-confirm' => Yii::t('backend', 'Are you sure you want to flush this cache?'),
                                    'class' => ['btn', 'btn-xs', 'btn-danger']
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo Yii::t('backend', 'Cache elements') ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12">
                    <h4><?php echo Yii::t('backend', 'Delete a value with the specified key from cache') ?></h4>
                    <?php \yii\bootstrap4\ActiveForm::begin([
                        'action' => \yii\helpers\Url::to('flush-cache-key'),
                        'method' => 'get',
                        'layout' => 'inline',
                    ]) ?>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <?php echo Html::dropDownList('id', null, \yii\helpers\ArrayHelper::map($dataProvider->allModels, 'name', 'name'), [
                                'class' => 'form-control',
                                'prompt' => Yii::t('backend', 'Select cache')
                            ]) ?>
                        </div>
                        <?php echo Html::input('string', 'key', null, ['class' => 'form-control', 'placeholder' => Yii::t('backend', 'Key')]) ?>
                        <div class="input-group-append">
                            <?php echo Html::submitButton(FAS::icon('eraser').' '.Yii::t('backend', 'Flush'), ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                    <?php \yii\bootstrap4\ActiveForm::end() ?>
                </div>
                <div class="col-xs-12">
                    <h4><?php echo Yii::t('backend', 'Invalidate tag dependency') ?></h4>
                    <?php \yii\bootstrap4\ActiveForm::begin([
                        'action' => \yii\helpers\Url::to('flush-cache-tag'),
                        'method' => 'get',
                        'layout' => 'inline',
                    ]) ?>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <?php echo Html::dropDownList('id', null, \yii\helpers\ArrayHelper::map($dataProvider->allModels, 'name', 'name'), [
                                'class' => 'form-control',
                                'prompt' => Yii::t('backend', 'Select cache')
                            ]) ?>
                        </div>
                        <?php echo Html::input('string', 'tag', null, ['class' => 'form-control', 'placeholder' => Yii::t('backend', 'Tag')]) ?>
                        <div class="input-group-append">
                            <?php echo Html::submitButton(FAS::icon('eraser').' '.Yii::t('backend', 'Flush'), ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                    <?php \yii\bootstrap4\ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
