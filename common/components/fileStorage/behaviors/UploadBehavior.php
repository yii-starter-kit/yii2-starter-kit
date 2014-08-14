<?php
/**
 * @copyright Copyright (c) 2014 Eugine terentev
 * @license http://opensource.org/licenses/MIT
 */

namespace common\components\fileStorage\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 *
 * Example:
 *
 * ```php
 * public function behaviors()
 * {
 *      return [
 *          'file' => [
 *              'class' => UploadBehavior::className(),
 *              'uploadAttribute' => 'file',
 *              'resultAttribute' => 'path',
 *              'fileCategory' => 'products',
 *              'fileRepository' => 'filesystem',
 *              'fileProcessing'=>function($file, $uploadAction){
 *                  // resize etc
 *              }
 *          ],
 *      ];
 * }
 * ```
 *
 */
class UploadBehavior extends Behavior
{
    public $uploadAttribute;
    public $resultAttribute;

    public $fileCategory;
    public $fileRepository;

    /***
     * @var \Closure
     * ```php
     * function($file) {
     *     // process file value
     * }
     * ```
     */
    public $fileProcessing;

    /**
     * @var \yii\web\UploadedFile
     */
    private $_uploadedFile;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'afterValidate',
        ];
    }

    public function beforeValidate()
    {
        $this->_uploadedFile = UploadedFile::getInstance($this->owner, $this->uploadAttribute);
        if ($this->_uploadedFile && !$this->_uploadedFile->hasError) {
            $this->owner->{$this->uploadAttribute} = $this->_uploadedFile;
        }
    }

    public function afterValidate(){
        if($this->_uploadedFile && !$this->_uploadedFile->hasError){
            $this->_save();
        }
    }


    public function afterDelete()
    {
        //$this->_delete();
    }

    private function _save()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $file = Yii::$app->fileStorage->save($this->_uploadedFile, $this->fileCategory, $this->fileRepository);
        if($file && !$file->error) {
            if ($this->fileProcessing instanceof \Closure) {
                call_user_func($this->fileProcessing, $file);
            }
            // delete the old version if it necessary
            //$this->_delete();
            $model->setAttribute($this->resultAttribute, $file->url);
        }
    }

    private function _delete()
    {
        $old = $this->owner->getOldAttribute($this->resultAttribute);
        if($old && $old != '') {
            Yii::$app->fileStorage->delete();
        }
    }
}