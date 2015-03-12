<?php

namespace backend\controllers;

use common\models\WidgetCarousel;
use Yii;
use common\models\WidgetCarouselItem;
use backend\models\search\WidgetCarouselItemSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WidgetCarouselItemController implements the CRUD actions for WidgetCarouselItem model.
 */
class WidgetCarouselItemController extends Controller
{

    public function getViewPath()
    {
        return $this->module->getViewPath() . DIRECTORY_SEPARATOR . 'widget-carousel/item';
    }

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
     * Creates a new WidgetCarouselItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($carousel_id)
    {
        $model = new WidgetCarouselItem();
        $carousel = WidgetCarousel::findOne($carousel_id);
        if (!$carousel) {
            throw new HttpException(400);
        }

        $model->carousel_id =  $carousel->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert', ['options'=>['class'=>'alert-success'], 'body'=>Yii::t('backend', 'Carousel slide was successfully saved')]);
                return $this->redirect(['/widget-carousel/update', 'id' => $model->carousel_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'carousel' => $carousel,
        ]);
    }

    /**
     * Updates an existing WidgetCarouselItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert', ['options'=>['class'=>'alert-success'], 'body'=>Yii::t('backend', 'Carousel slide was successfully saved')]);
            return $this->redirect(['/widget-carousel/update', 'id' => $model->carousel_id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WidgetCarouselItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            return $this->redirect(['/widget-carousel/update', 'id'=>$model->carousel_id]);
        };
    }

    /**
     * Finds the WidgetCarouselItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WidgetCarouselItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetCarouselItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
