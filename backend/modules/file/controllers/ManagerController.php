<?php

namespace backend\modules\file\controllers;

use yii\web\Controller;

class ManagerController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
