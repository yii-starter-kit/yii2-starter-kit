<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @var string $maintenanceText
 * @var int|string $retryAfter
 */
?>
<div class="jumbotron">
    <p>
        <?php echo Yii::t('common', $maintenanceText, [
            'retryAfter' => $retryAfter,
            'adminEmail' => Yii::$app->params['adminEmail']
        ]) ?>
    </p>
</div>