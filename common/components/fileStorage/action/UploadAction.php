<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 1:19 PM
 */

namespace common\components\fileStorage\action;

use yii\base\Action;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\UploadedFile;

class UploadAction extends Action{

    public $fileParam = 'file';

    public $model;
    public $attribute;
    public $responseFormat = Response::FORMAT_JSON;
    public $responsePathParam = 'path';
    public $responseUrlParam = 'url';

    public function init(){
        \Yii::$app->response->format = $this->responseFormat;
        if($this->model && $this->attribute){
            $this->fileParam = Html::getInputName($this->model, $this->attribute);
        }
    }

    public function run()
    {
        $file = \Yii::$app->fileStorage->save(UploadedFile::getInstanceByName($this->fileParam));
        if(!$file->error){
            return [
                $this->responsePathParam => $file->path,
                $this->responseUrlParam => $file->url,
            ];
        }
    }
} 