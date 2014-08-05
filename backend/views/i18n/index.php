<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\\models\search\I18MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'I18 Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18-message-index">

    <div id="search">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#search" href="#searchForm">
                        <?= Yii::t('backend', 'Search') ?>
                    </a>
                </h4>
            </div>
            <div id="searchForm" class="panel-collapse collapse" style="height: auto;">
                <div class="box-body">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sourceCategory',
            'sourceMessage:ntext',
            'language',
            'translation:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
