<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <!-- CSS  -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/materialize.css" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="<?php echo $this->theme->baseUrl ?>/css/style.css" type="text/css" rel="stylesheet"
          media="screen,projection"/>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/materialize.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/init.js"></script>
</head>