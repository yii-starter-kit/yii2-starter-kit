<?php

namespace backend\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actions(){
        return [
            'upload-imperavi'=>[
                'class'=>'trntv\filekit\actions\UploadAction',
                'fileparam'=>'file',
                'responseUrlParam'=>'filelink',
                'disableCsrf'=>true
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
