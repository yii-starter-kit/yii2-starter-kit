<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:01 PM
 */

namespace app\controllers;

use app\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class PageController extends Controller
{
    public function actionView($alias){
        $model = Page::find()->where(['alias'=>$alias, 'status'=>Page::STATUS_PUBLISHED])->one();
        if(!$model){
            throw new NotFoundHttpException;
        }
        return $this->render('view', ['model'=>$model]);
    }
} 