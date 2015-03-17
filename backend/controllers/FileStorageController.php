<?php

namespace backend\controllers;

use Yii;
use trntv\filekit\storage\File;
use trntv\filekit\storage\models\FileStorageItem;
use backend\models\search\FileStorageItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FileStorageController implements the CRUD actions for FileStorageItem model.
 */
class FileStorageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['delete']
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'upload'=>[
                'class'=>'trntv\filekit\actions\UploadAction'
            ],
            'delete'=>[
                'class'=>'trntv\filekit\actions\DeleteAction'
            ],
            'upload-imperavi'=>[
                'class'=>'trntv\filekit\actions\UploadAction',
                'fileparam'=>'file',
                'responseUrlParam'=>'filelink',
                'disableCsrf'=>true
            ]
        ];
    }
}
