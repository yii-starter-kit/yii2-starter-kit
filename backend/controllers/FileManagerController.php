<?php

namespace backend\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actions(){
        return [
            'upload-imperavi'=>[
                'class'=>'trntv\yii2-file-kit\actions\UploadAction',
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
