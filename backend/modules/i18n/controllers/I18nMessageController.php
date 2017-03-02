<?php

namespace backend\modules\i18n\controllers;

use backend\modules\i18n\models\I18nSourceMessage;
use Yii;
use backend\modules\i18n\models\I18nMessage;
use backend\modules\i18n\models\search\I18nMessageSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * I18nMessageController implements the CRUD actions for I18nMessage model.
 */
class I18nMessageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all I18nMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new I18nMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        Url::remember(Yii::$app->request->getUrl(), 'i18n-messages-filter');

        $languages = ArrayHelper::map(
            I18nMessage::find()->select('language')->distinct()->all(),
            'language',
            'language'
        );
        $categories = ArrayHelper::map(
            I18nSourceMessage::find()->select('category')->distinct()->all(),
            'category',
            'category'
        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'languages' => $languages,
            'categories' => $categories
        ]);
    }

    /**
     * Creates a new I18nMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new I18nMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing I18nMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($id, $language)
    {
        $model = $this->findModel($id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous('i18n-messages-filter') ?: ['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing I18nMessage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($id, $language)
    {
        $this->findModel($id, $language)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the I18nMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $language
     * @return I18nMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $language)
    {
        if (($model = I18nMessage::findOne(['id' => $id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
