<?php

namespace app\modules\manager\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actions(){
        return [
            'upload-imperavi'=>[
                'class'=>'app\components\storage\action\UploadAction',
                'responseUrlParam'=>'filelink'
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
