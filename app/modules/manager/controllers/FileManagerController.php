<?php

namespace app\modules\manager\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
