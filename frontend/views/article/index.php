<?php
/* @var $this yii\web\View */
$this->title = Yii::t('frontend', 'Articles')
?>
<?php echo $this->render('_typehead');?>
<div id="article-index">
    <h1><?php echo Yii::t('frontend', 'Articles') ?></h1>
    <?php echo \yii\widgets\ListView::widget([
        'dataProvider'=>$dataProvider,
        'pager'=>[
            'hideOnSinglePage'=>true,
        ],
        'itemView'=>'_item'
    ])?>
</div>