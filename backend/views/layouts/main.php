<?php
/**
 * @var $this yii\web\View
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
    <div class="box">
        <div class="box-body">
            <?= $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>