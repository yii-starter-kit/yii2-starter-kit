<?php

use trntv\filekit\storage\models\FileStorageItem;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FileStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $totalSize integer */
/* @var $repositories array */

$this->title = Yii::t('backend', 'File Storage Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-storage-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-xs-6">
            <?= Html::a(Yii::t('backend', 'Upload file'), ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend', 'Reset file storage'), ['reset'], ['class' => 'btn btn-danger',
                'data-method'=>'post', 'data-pjax'=>0, 'data-confirm'=>Yii::t('backend', 'Are you sure ypu want to reset File Storage?')
            ]) ?>
        </div>
        <div class="col-xs-6 text-right">
            <dl>
                <dt>
                    <?= Yii::t('backend', 'Used size') ?>:
                </dt>
                <dd>
                    <?= Yii::$app->formatter->asSize($totalSize); ?>
                </dd>
            </dl>

        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute'=>'repository',
                'filter'=>$repositories
            ],
            'url:url',
            'size',
            'mimeType',
            'upload_ip',
            'status',
            'created_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete}'
            ],
        ],
    ]); ?>

</div>
