<?php if (Yii::$app->getSession()->hasFlash('success')): ?>
  <div class="alert alert-success">
    <p><?= Yii::$app->getSession()->getFlash('success') ?></p>
  </div>
<?php endif; ?><?php if (Yii::$app->getSession()->hasFlash('error')): ?>
  <div class="alert alert-danger">
    <p><?= Yii::$app->getSession()->getFlash('error') ?></p>
  </div>
<?php endif; ?>