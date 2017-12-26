<?php

namespace backend\modules\yii2starterkitrbaccrud\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rbac-crud` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
