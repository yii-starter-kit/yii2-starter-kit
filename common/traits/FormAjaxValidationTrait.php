<?php

namespace common\traits;

use Yii;
use yii\base\ExitException;
use yii\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;

trait FormAjaxValidationTrait
{

    /**
     * @param array|Model $model
     *
     * @throws ExitException
     */
    protected function performAjaxValidation($model)
    {
        if (Yii::$app->request->isAjax && !Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = ActiveForm::validate($model);
                Yii::$app->end();
            }
        }
    }

}