<?php

namespace backend\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actions(){
        return [
            'upload-imperavi'=>[
                'class'=>'common\components\fileStorage\action\UploadAction',
                'fileparam'=>'file',
                'responseUrlParam'=>'filelink'
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
