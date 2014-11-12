<?php

namespace frontend\modules\user\controllers;

use frontend\modules\user\models\AccountForm;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\AccessControl;
use yii\imagine\Image;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actions(){
        return [
            'avatar-upload'=>[
                'class'=>UploadAction::className(),
                'fileProcessing'=>function($file){
                    Image::thumbnail($file->path->getPath(), 215,215)
                        ->save($file->path->getPath());
                }
            ]
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $model = new AccountForm();
        $model->username = $user->username;
        if($model->load($_POST) && $model->validate()){
            $user->username = $model->username;
            $user->setPassword($model->password);
            $user->save();
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('frontend', 'Your profile has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('index', ['model'=>$model]);
    }

    public function actionProfile()
    {
        $model = Yii::$app->user->identity->profile;
        if($model->load($_POST) && $model->save()){
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('frontend', 'Your profile has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('profile', ['model'=>$model]);
    }
}
