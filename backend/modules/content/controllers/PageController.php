<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\search\PageSearch;
use common\models\Page;
use common\traits\FormAjaxValidationTrait;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
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
        $page = new Page();

        $this->performAjaxValidation($page);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->redirect(['index']);
        }
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $page,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $page = new Page();

        $this->performAjaxValidation($page);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $page,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $page = $this->findModel($id);

        $this->performAjaxValidation($page);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $page,
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
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
