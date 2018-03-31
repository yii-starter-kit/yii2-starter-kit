<?php

namespace backend\modules\widget\controllers;

use backend\modules\widget\models\search\MenuSearch;
use common\models\WidgetMenu;
use common\traits\FormAjaxValidationTrait;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MenuController extends Controller
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
        $widgetMenu = new WidgetMenu();

        $this->performAjaxValidation($widgetMenu);

        if ($widgetMenu->load(Yii::$app->request->post()) && $widgetMenu->save()) {
            return $this->redirect(['index']);
        } else {
            $searchModel = new MenuSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $widgetMenu,
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
        $widgetMenu = $this->findWidget($id);

        $this->performAjaxValidation($widgetMenu);

        if ($widgetMenu->load(Yii::$app->request->post()) && $widgetMenu->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $widgetMenu,
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
     * @return WidgetMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWidget($id)
    {
        if (($model = WidgetMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
