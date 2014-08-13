<?php
namespace common\components\fileStorage\action;

use common\components\fileStorage\File;
use yii\base\Action;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\UploadedFile;

/**
* public function actions(){
*   return [
*           'upload'=>[
*               'class'=>'common\components\fileStorage\action\UploadAction',
*               'responseUrlParam'=>'file-url',
 *              'fileProcessing'=>function($file, $uploadAction){
                    // do something
 *              }
*           ]
*       ];
*   }
*/


class UploadAction extends Action{

    public $fileparam = 'file';

    public $model;
    public $attribute;

    public $fileCategory;
    public $fileCategoryParam = 'category';

    public $repository;

    // todo: Check types, max size, max count, etc;

    public $responseFormat = Response::FORMAT_JSON;
    public $responsePathParam = 'path';
    public $responseUrlParam = 'url';
    public $responseExtensionParam = 'extension';
    public $responseMimeTypeParam = 'mimeType';
    public $responseSizeParam = 'size';

    /**
     * @var \Closure
     * ```php
     * function($file, $uploadAction) {
     *     // process file value
     * }
     * ```
     */
    public $fileProcessing;

    public function init(){
        \Yii::$app->response->format = $this->responseFormat;
        if(\Yii::$app->request->get('fileparam')){
            $this->fileparam = \Yii::$app->request->get('fileparam');
        }
        if($this->model && $this->attribute){
            $this->fileparam = Html::getInputName($this->model, $this->attribute);
        }
        if(!$this->fileCategory){
            $this->fileCategory = \Yii::$app->request->get($this->fileCategoryParam);
        }
    }

    public function run()
    {
        $result = ['success'=>[], 'error'=>[]];
        $files = UploadedFile::getInstancesByName($this->fileparam);
        foreach ($files as $file) {
            if(!$file->error){
                $file = \Yii::$app->fileStorage->save(File::load($file), $this->fileCategory, $this->repository);
                if (!$file->error) {
                    if ($this->fileProcessing instanceof \Closure) {
                        call_user_func($this->fileProcessing, $file, $this);
                    }
                    $result['success'][] = [
                        $this->responsePathParam => $file->path,
                        $this->responseUrlParam => $file->url,
                        $this->responseExtensionParam => $file->extension,
                        $this->responseMimeTypeParam => $file->mimeType,
                        $this->responseSizeParam => $file->size,
                    ];
                } else {
                    $result['error'][] = [
                        $file->name => $file->error
                    ];
                }
            } else {
                $result['error'][] = [
                    $file->name => $file->error
                ];
            }
        }
        return $result;
    }

} 