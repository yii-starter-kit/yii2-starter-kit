<?php

namespace backend\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actions(){
        return [
            'upload-imperavi'=>[
                'class'=>'common\components\storage\action\UploadAction',
                'responseUrlParam'=>'filelink'
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
