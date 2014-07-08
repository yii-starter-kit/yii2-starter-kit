<?php
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Articles')
?>
<div id="article-index">
    <h1><?= Yii::t('app', 'Articles') ?></h1>
    <?= \yii\widgets\ListView::widget([
        'dataProvider'=>$dataProvider,
        'pager'=>[
            'hideOnSinglePage'=>true,
        ],
        'itemView'=>'_item'
    ])?>
</div>