<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\search\ArticleSearch;
use common\models\Article;
use common\models\ArticleCategory;
use common\traits\FormAjaxValidationTrait;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller
{
    use FormAjaxValidationTrait;

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC],
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $article = new Article();

        $this->performAjaxValidation($article);

        if ($article->load(Yii::$app->request->post()) && $article->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $article,
            'categories' => ArticleCategory::find()->active()->all(),
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $article = $this->findModel($id);

        $this->performAjaxValidation($article);

        if ($article->load(Yii::$app->request->post()) && $article->save()) {
            return $this->redirect(['index']);
        }

        $article->published_at = date('Y-m-d H:i:s', $article->published_at);

        return $this->render('update', [
            'model' => $article,
            'categories' => ArticleCategory::find()->active()->all(),
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     *
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');

    }

}
