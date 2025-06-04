<?php

namespace backend\modules\system\controllers;

use backend\modules\system\models\search\SystemLogSearch;
use backend\modules\system\models\SystemLog;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LogController implements the CRUD actions for SystemLog model.
 */
class LogController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'clear-logs' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SystemLog models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (strcasecmp(Yii::$app->request->method, 'delete') == 0) {
            SystemLog::deleteAll($dataProvider->query->where);

            return $this->refresh();
        }
        $dataProvider->sort = [
            'defaultOrder' => ['log_time' => SORT_DESC],
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionClearLogs()
    {
        SystemLog::deleteAll();
        Yii::$app->session->setFlash('alert', [
            'body' => \Yii::t('backend', 'The logs have been cleared'),
            'options' => ['class' => 'alert-success'],
        ]);

        return $this->redirect(['index']);
    }

    /**
     * Displays a single SystemLog model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing SystemLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
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
     * Finds the SystemLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return SystemLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
