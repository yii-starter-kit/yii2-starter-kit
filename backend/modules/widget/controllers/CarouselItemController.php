<?php

namespace backend\modules\widget\controllers;

use common\models\WidgetCarousel;
use common\models\WidgetCarouselItem;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class CarouselItemController extends Controller
{

    /** @inheritdoc */
    public function getViewPath()
    {
        return $this->module->getViewPath() . DIRECTORY_SEPARATOR . 'carousel/item';
    }

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
     * @param $carousel_id
     *
     * @return mixed
     * @throws HttpException
     */
    public function actionCreate($carousel_id)
    {
        $model = new WidgetCarouselItem();
        $carousel = WidgetCarousel::findOne($carousel_id);
        if (!$carousel) {
            throw new HttpException(400);
        }

        $model->carousel_id = $carousel->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert', ['options' => ['class' => 'alert-success'], 'body' => Yii::t('backend', 'Carousel slide was successfully saved')]);

                return $this->redirect(['/widget/carousel/update', 'id' => $model->carousel_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'carousel' => $carousel,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findItem($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert', ['options' => ['class' => 'alert-success'], 'body' => Yii::t('backend', 'Carousel slide was successfully saved')]);

            return $this->redirect(['/widget/carousel/update', 'id' => $model->carousel_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        ($model = $this->findItem($id))->delete();

        return $this->redirect(['/widget/carousel/update', 'id' => $model->carousel_id]);
    }

    /**
     * @param integer $id
     *
     * @return WidgetCarouselItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findItem($id)
    {
        if (($model = WidgetCarouselItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
