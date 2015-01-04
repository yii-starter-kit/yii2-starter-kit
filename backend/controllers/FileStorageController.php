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
                    'delete' => ['post'],
                    'reset' => ['post'],
                ],
            ],
        ];
    }

    public function actions(){
        return [
            'upload'=>[
                'class'=>'trntv\filekit\actions\UploadAction'
            ],
            'upload-imperavi'=>[
                'class'=>'trntv\filekit\actions\UploadAction',
                'fileparam'=>'file',
                'responseUrlParam'=>'filelink',
                'disableCsrf'=>true
            ]
        ];
    }

    /**
     * Lists all FileStorageItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileStorageItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ];

        $repositories = \yii\helpers\ArrayHelper::map(
            FileStorageItem::find()->select('repository')->distinct()->all(), 'repository', 'repository'
        );
        $totalSize = FileStorageItem::find()->where(['status' => FileStorageItem::STATUS_UPLOADED])->sum('size');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalSize'=> $totalSize,
            'repositories' => $repositories
        ]);
    }

    /**
     * Displays a single FileStorageItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FileStorageItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileStorageItem();
        if($model->load($_POST))
        if($file = UploadedFile::getInstance($model, 'path')){
            $file = Yii::$app->fileStorage->save($file, $model->repository);
            if(!$file->error){
                return $this->redirect(['index']);
            } else {
                $model->addError('path', $file->error);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionReset(){
        $rows = Yii::$app->db->createCommand('SELECT DISTINCT repository FROM {{%file_storage_item}}')->queryAll();
        foreach($rows as $row){
            Yii::$app->fileStorage->getRepository($row['repository'])->reset();
        }
        FileStorageItem::deleteAll();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing FileStorageItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->status == FileStorageItem::STATUS_DELETED){
            $model->delete();
        } else {
            $file = File::load($model->path);
            Yii::$app->fileStorage->delete($file, $model->repository);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the FileStorageItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileStorageItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileStorageItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
