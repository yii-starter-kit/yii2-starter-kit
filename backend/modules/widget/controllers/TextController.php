<?php

namespace backend\modules\widget\controllers;

use backend\modules\widget\models\search\TextSearch;
use common\models\WidgetText;
use common\traits\FormAjaxValidationTrait;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TextController extends Controller
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
        $widgetText = new WidgetText();

        $this->performAjaxValidation($widgetText);

        if ($widgetText->load(Yii::$app->request->post()) && $widgetText->save()) {
            return $this->redirect(['index']);
        } else {
            $searchModel = new TextSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $widgetText,
            ]);
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $widgetText = $this->findWidget($id);

        $this->performAjaxValidation($widgetText);

        if ($widgetText->load(Yii::$app->request->post()) && $widgetText->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $widgetText,
            ]);
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findWidget($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     *
     * @return WidgetText the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWidget($id)
    {
        if (($model = WidgetText::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
