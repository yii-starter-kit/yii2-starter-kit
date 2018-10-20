<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
    <div class="box">
        <div class="box-body">
            <?php echo $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>
