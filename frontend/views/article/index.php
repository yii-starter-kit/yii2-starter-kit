<?php
/* @var $this yii\web\View */
$this->title = Yii::t('common', 'Articles')
?>
<div id="article-index">
    <h1><?= Yii::t('common', 'Articles') ?></h1>
    <?= \yii\widgets\ListView::widget([
        'dataProvider'=>$dataProvider,
        'pager'=>[
            'hideOnSinglePage'=>true,
        ],
        'itemView'=>'_item'
    ])?>
</div>