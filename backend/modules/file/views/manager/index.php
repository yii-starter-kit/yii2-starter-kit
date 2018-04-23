<?php

/**
 * @var $this yii\web\View
 */

$this->title = Yii::t('backend', 'File Manager');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-xs-12">
        <?php echo alexantr\elfinder\ElFinder::widget([
            'connectorRoute' => ['connector'],
            'settings' => [
                'height' => '500px',
                'width' => '100%'
            ],
            'buttonNoConflict' => true,
        ]) ?>
    </div>
</div>
