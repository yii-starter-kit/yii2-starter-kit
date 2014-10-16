<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:25 PM
 */

namespace frontend\controllers;

use common\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(
            [
                'query'=>Article::find()->with('author')->published()->orderBy(['created_at'=>SORT_DESC])
            ]
        );
        return $this->render('index', ['dataProvider'=>$dataProvider]);
    }

    public function actionView($id)
    {
        $model = Article::find()->published()->with('author')->andWhere(['id'=>$id])->one();
        if(!$model){
            throw new NotFoundHttpException;
        }
        return $this->render('view', ['model'=>$model]);
    }
} 